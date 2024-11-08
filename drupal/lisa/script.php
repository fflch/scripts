<?php
/*
 * script por: Augusto Santiago
 *
No terminal, diretório do projeto do Drupal, digite: ./vendor/bin/drupal serve -vvv
Acesse o link do site, geralmente http://127.0.0.1:8088/, no navegador

Crie um diretório no servidor onde os dados PDF serão copiados.
Execute o seguinte comando, considerando o caminho para o seu dado de script:

./vendor/bin/drush php-script /home/acesarfs/projetos/scripts/drupal/lisa/script.php

 */
use \Drupal\node\Entity\Node;
use \Drupal\file\Entity\File;

$home_dir = "/home/acesarfs/";
$dados_csv = file_get_contents($home_dir . 'projetos/scripts/drupal/lisa/lisa.csv');
$dados = explode(PHP_EOL, $dados_csv);
$dados_array = array();

//var_dump($dados);
//die();

foreach ($dados as $dado) {
    $dados_array[] = str_getcsv($dado);
}
array_pop($dados_array);

//var_dump($dados_array);
//die();

$full_path = $home_dir . 'LISA/arquivos/';

//var_dump($full_path);
//die();

$arquivos = scandir($full_path);

//var_dump($dados);
//die();

foreach($dados_array as $coluna) {
    $titulo = $coluna[1];
    $arquivos_relacionados = [];
    foreach($arquivos as $arquivo){
        if(str_contains($arquivo, $titulo)){
            $arquivos_relacionados[] = $arquivo;
        }
    }

    //var_dump($dados_relacionados);
    //die();

	$node = Node::load($coluna[0]);
    $node->title->value = $coluna[1];
    foreach($arquivos_relacionados as $arquivo_relacionado) {

        $arquivo_conteudo = file_get_contents($full_path.$arquivo_relacionado);
        $file = file_save_data($arquivo_conteudo, 'public://'.'LISA/'.$arquivo_relacionado, FILE_EXISTS_REPLACE);
        
        $field_imagem = array(
            'target_id' => $file->id(),
            'alt'       => 'Arquivo ' . $file->id(),
            'title'     => "LISA Imagem",
        );

    }

    $node->field_imagem = $field_imagem;
    $node->save();
}
