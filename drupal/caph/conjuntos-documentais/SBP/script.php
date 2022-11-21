<?php
//autora: Sabrina 
echo "iniciando script";

//tarefa 1 ler o arquivo csv
//tarefa 2 criar um array para cada linha do arquivo csv
$arquivocsv = file_get_contents('SBP.csv');
$lines = explode(PHP_EOL, $arquivocsv);

$array = array();

foreach ($lines as $line) {
    $array[] = str_getcsv($line);
}

var_dump($array);