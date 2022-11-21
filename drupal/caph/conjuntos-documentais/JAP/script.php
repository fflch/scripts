<?php

//Autora: Aline

echo "iniciando script";

//Tarefa 1: Ler arquivo CSV, 
//Tarfa 2 : Criar um array para cada linha do arquivo csv

$arquivocsv = file_get_contents('JAP.csv');
$lines = explode(PHP_EOL, $arquivocsv);

$array = array();

foreach ($lines as $line) {
    $array[] = str_getcsv($line);
}

var_dump($array);