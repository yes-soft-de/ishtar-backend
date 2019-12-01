@ECHO OFF
TITLE Yes Soft test
ECHO Welcome!
ECHO ========
ECHO Ishtar load test
ECHO ============================
set /p host="Enter Host (www.example.com or 127.0.0.1): "
ECHO ============================
set /p port="Enter Port (use 80 for online): "
ECHO ============================
set /p email="Enter Email: "
ECHO ============================
set /p password="Enter Password: "
ECHO ============================
ECHO Please wait... Excuting the test..
ECHO ============================
SET batPath=%~dp0
CAll cd/d %JmeterPath%
Call jmeter -n -t %batPath%loadtest-ishtar.jmx -l %batPath%\TestResults\loadtest-result.csv -e -o %batPath%TestResults\ -f -Jhost=%host% -Jport=%port% -Jemail=%email% -Jpassword=%password%
ECHO ============================
ECHO Test finshed please see %batPath%TestResults\ for results
ECHO ============================
PAUSE