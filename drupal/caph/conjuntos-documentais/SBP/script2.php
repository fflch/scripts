<?php
$arquivocsv = file_get_contents('Livros.csv');
$livros = explode(PHP_EOL, $arquivocsv);

$livros_array = array();

foreach ($livros as $livro) {
    $livros_array[] = str_getcsv($livro);
}

array_pop($livros_array);

use \Drupal\node\Entity\Node;
foreach($livros_array as $coluna) {
    $node = Node::create([
        'type'        => 'livros',
        'title'       => $coluna[0],
        'field_autor' => $coluna[1],
        'field_numero_de_paginas'     => $coluna[2],
    ]);
    echo $node->save();
}