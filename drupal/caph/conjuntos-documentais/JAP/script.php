<?php

//Autora: Aline

$arquivocsv = file_get_contents('JAP.csv');
$arquivos = explode(PHP_EOL, $arquivocsv);

$arquivos_array = array();

foreach ($arquivos as $arquivo) {
    $arquivos_array[] = str_getcsv($arquivo);
}

array_pop($arquivos_array);

use \Drupal\node\Entity\Node;
foreach($arquivos_array as $campo) {
    $node = Node::create([
        'type'                              => 'arquivos',
        'title'                             => $campo[0],
        'field_notacao'                     => $campo[1],
        'field_documento'                   => $campo[2],
        'field_abordagem'                   => $campo[3],
        'field_local_de_producao'           => $campo[4],
        'field_data_de_producao'            => $campo[5],
        'field_tecnica_de_registro'         => $campo[6],
        'field_suporte'                     => $campo[7],
        'field_formato'                     => $campo[8],
        'field_cromia'                      => $campo[9],
        'field_idioma'                      => $campo[10],
        'field_numero_de_itens'             => $campo[11],
        'field_numero_de_exemplares'        => $campo[12],
        'field_extensao_1_'                 => $campo[13],
        'field_extensao_2_'                 => $campo[14],
        'field_responsavel_1_'              => $campo[15],
        'field_tipo_de_responsabilidade_1'  => $campo[16],
        'field_responsavel_2_'              => $campo[17],
        'field_tipo_de_responsabilidade_2'  => $campo[18],
        'field_responsaveis_3_'             => $campo[19],
        'field_tipo_de_responsabilidade_3'  => $campo[20],
        'field_responsaveis_4_'             => $campo[21],
        'field_tipo_de_responsabilidade_4'  => $campo[22],
        'field_atividade_evento'            => $campo[23],
        'field_especificacao_1_'            => $campo[24],
        'field_local_1_'                    => $campo[25],
        'field_data_ou_periodo_1_'          => $campo[26],
        'field_atividade_evento_2_'         => $campo[27],
        'field_especificacao_2_'            => $campo[28],
        'field_local_2_'                    => $campo[29],
        'field_data_ou_periodo_2_'          => $campo[30],
        'field_descritores'                 => $campo[31],
        'field_referencia'                  => $campo[32],
        'field_observacoes'                 => $campo[33],
    ]);
    echo $node->save();
}