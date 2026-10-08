   const clockTarget = document.getElementById('clock');
        const dateTarget = document.getElementById('date');
        const weatherPlace = document.getElementById('weather-place');
        const weatherSummary = document.getElementById('weather-summary');
        const weatherTemp = document.getElementById('weather-temp');
        const weatherCacheKey = 'homescreen-weather-cache';
        const weatherCacheTtl = 2 * 60 * 60 * 1000;

        const timeFormatter = new Intl.DateTimeFormat('en', {
            hour: 'numeric',
            minute: '2-digit'
        });

        const dateFormatter = new Intl.DateTimeFormat('en', {
            month: 'long',
            day: 'numeric',
            year: 'numeric'
        });

        function refreshClock() {
            const now = new Date();
            clockTarget.textContent = timeFormatter.format(now).replace('AM', 'am').replace('PM', 'pm');
            dateTarget.textContent = dateFormatter.format(now);
        }

        function weatherLabel(code) {
            const labels = {
                0: 'Clear sky',
                1: 'Mainly clear',
                2: 'Partly cloudy',
                3: 'Overcast',
                45: 'Foggy',
                48: 'Rime fog',
                51: 'Light drizzle',
                53: 'Drizzle',
                55: 'Heavy drizzle',
                61: 'Light rain',
                63: 'Rain',
                65: 'Heavy rain',
                71: 'Light snow',
                73: 'Snow',
                75: 'Heavy snow',
                80: 'Rain showers',
                81: 'Rain showers',
                82: 'Heavy showers',
                95: 'Thunderstorm'
            };

            return labels[code] || 'Local conditions';
        }

        function readWeatherCache() {
            try {
                const cached = JSON.parse(localStorage.getItem(weatherCacheKey));
                if (!cached || typeof cached.savedAt !== 'number') {
                    return null;
                }

                if (Date.now() - cached.savedAt > weatherCacheTtl) {
                    return null;
                }

                return cached;
            } catch (error) {
                return null;
            }
        }

        function writeWeatherCache(data) {
            try {
                localStorage.setItem(weatherCacheKey, JSON.stringify({
                    ...data,
                    savedAt: Date.now()
                }));
            } catch (error) {
                // Ignore storage failures and fall back to live fetches.
            }
        }

        function applyWeatherState(state) {
            weatherPlace.textContent = state.place || 'Your area';
            weatherSummary.textContent = state.summary || 'Offline mode';
            weatherTemp.textContent = state.temp || '--°';
        }

        async function loadWeather() {
            const cachedWeather = readWeatherCache();
            if (cachedWeather) {
                applyWeatherState(cachedWeather);
                return;
            }

            if (!navigator.onLine) {
                applyWeatherState({
                    place: 'Your area',
                    summary: 'Offline mode',
                    temp: '--°'
                });
                return;
            }

            try {
                const locationResponse = await fetch('https://ipwho.is/');
                if (!locationResponse.ok) {
                    throw new Error('Location lookup failed');
                }

                const location = await locationResponse.json();
                if (!location.success || typeof location.latitude !== 'number' || typeof location.longitude !== 'number') {
                    throw new Error('Missing coordinates');
                }

                const place = [location.city || location.region || 'Your area', location.country || ''].filter(Boolean).join(', ');

                const weatherResponse = await fetch(`https://api.open-meteo.com/v1/forecast?latitude=${location.latitude}&longitude=${location.longitude}&current=temperature_2m,weather_code&timezone=auto`);
                if (!weatherResponse.ok) {
                    throw new Error('Weather lookup failed');
                }

                const weather = await weatherResponse.json();
                const state = {
                    place,
                    summary: weatherLabel(weather.current.weather_code),
                    temp: `${Math.round(weather.current.temperature_2m)}°`
                };

                applyWeatherState(state);
                writeWeatherCache(state);
            } catch (error) {
                applyWeatherState({
                    place: 'Your area',
                    summary: 'Offline mode',
                    temp: '--°'
                });
            }
        }

        refreshClock();
        loadWeather();
        setInterval(refreshClock, 1000);