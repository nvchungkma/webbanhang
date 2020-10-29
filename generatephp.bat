@ECHO OFF

mkdir EXPORT
call .\vendor\bin\doctrine.bat orm:convert-mapping --force --from-database annotation ./EXPORT/
call .\vendor\bin\doctrine.bat orm:generate-entities ./EXPORT/ --generate-annotations=true

pause