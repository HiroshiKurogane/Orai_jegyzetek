@echo off
cls
cd /d ./repo
echo example: https://github.com/username/repo_name.git
set /p "repo_url=Repo url: "
C:\Users\aczelmi\AppData\Local\Programs\Git\bin\git.exe init
echo "It's just an init file, don't mind it." > .init
C:\Users\aczelmi\AppData\Local\Programs\Git\bin\git.exe add .
C:\Users\aczelmi\AppData\Local\Programs\Git\bin\git.exe commit -m "init"
C:\Users\aczelmi\AppData\Local\Programs\Git\bin\git.exe branch -M main
C:\Users\aczelmi\AppData\Local\Programs\Git\bin\git.exe remote add origin "%repo_url%"
C:\Users\aczelmi\AppData\Local\Programs\Git\bin\git.exe push -u origin main
C:\Users\aczelmi\AppData\Local\Programs\Git\bin\git.exe add .
C:\Users\aczelmi\AppData\Local\Programs\Git\bin\git.exe commit -m "init"
C:\Users\aczelmi\AppData\Local\Programs\Git\bin\git.exe push

set /p DUMMY=Hit ENTER to exit...
