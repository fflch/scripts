<?php
//autora: Sabrina 
echo "iniciando script";

//tarefa 1 ler o arquivo csv
//tarefa 2 criar um array para cada linha do arquivo csv
$arquivocsv = file_get_contents('SBP.csv');
$lines = explode(PHP_EOL, $arquivocsv);

$array = array([
      'field_fundo',
      'field_notacao',
      'field_documento',
      'field_abordagem',
      'field_local_de_producao',
      'field_data_de_producao',
      'field_tecnica',
      'field_suporte',
      'field_formato',
      'field_cromia',
      'field_idioma',
      'field_n_itens',
      'field_n_exemplares',
      'field_extensao',
      'field_responsavel_1',
      'field_tipo_de_responsabilidade_1',
      'field_responsavel_2',
      'field_tipo_de_responsabilidade_2',
      'field_responsaveis_3',
      'field_tipo_de_responsabilidade_3',
      'field_atividade_evento_1',         
      'field_especificacao_1',
      'field_local_1',
      'field_data_ou_periodo_1',
      'field_atividade_evento_2',
      'field_especificacao_2',
      'field_local_2',
      'field_data_ou_periodo_2',
      'field_descritores',
      'field_descritores',
      'field_descritores',
      'field_referencia',
      'field_observacoes',

]);

foreach ($lines as $line) {
    $array[] = str_getcsv($line);
}

var_dump($array);