@echo off

::parte do código que lista as impressoras e armazena numa variavel
:: para rodar: remore_sansumg_printers.bat

wmic printer get name | find "samsung" > %TEMP%\info.txt

for /f "tokens=*" %%a in (%TEMP%\info.txt) do (
    printui.exe /dl /n %%a
)
