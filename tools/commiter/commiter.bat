@echo off
cls
cd /d ./repo

C:\Users\aczelmi\AppData\Local\Programs\Git\bin\git.exe add .

set /p "message=Message: "

if "%message%"=="" (
    C:\Users\aczelmi\AppData\Local\Programs\Git\bin\git.exe commit -m "Automatic update"
) else (
    C:\Users\aczelmi\AppData\Local\Programs\Git\bin\git.exe commit -m "%message%"
)

C:\Users\aczelmi\AppData\Local\Programs\Git\bin\git.exe push -u origin main

set /p "DUMMY=Hit ENTER to exit..."