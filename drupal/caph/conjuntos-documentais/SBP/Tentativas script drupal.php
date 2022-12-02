<?php

//códigos drupal CAPH. Confirmar utilidade e forma como foi feito.



//para criar a página (node) ??

use \Drupal\node\Entity\Node;
$node = Node::create([
    'type'                                  => 'documentos',
    'title'                                 => 'array SBP',
    'field_fundo'                           => 'SBP',
    'field_notacao'                         => ' ',
    'field_documento'                       => 'Cerfificado',
    'field_abordagem'                       => 'Unitária',
    'field_local_de_producao'               => 'Buenos Aires (Argentina)',
    'field_data_de_producao'                => '10/25/1977',
    'field_tecnica'                         => 'Impressão, Manuscrita',
    'field_suporte'                         => 'Papel',
    'field_formato'                         => 'Folha',
    'field_cromia'                          => ' ',
    'field_idioma'                          => 'Espanhol',
    'field_n_itens'                         => '1',
    'field_n_exemplares'                    => '1',
    'field_extensao'                        => '1f',
    'field_responsavel_1'                   => 'Juan Pablo Bozzini',
    'field_tipo_de_responsabilidade_1'      => 'Signatário',
    'field_responsavel_2'                   => 'Pedro Garaguso',
    'field_tipo_de_responsabilidade_2'      => 'Signatário',
    'field_responsaveis_3'                  => ' ',
    'field_tipo_de_responsabilidade_3'      => ' ',
    'field_atividade_evento_1'              => 'Homenagem póstuma',
    'field_especificacao_1'                 => 'Membro de honra da Federación Latinoamericana de Parasitologos',
    'field_local_1'                         => 'Buenos Aires (Argentina)',
    'field_data_ou-periodo_1'               => '10/25/19',
    'field_atividade_evento_2'              => ' ',
    'field_especificacao_2'                 => ' ',
    'field_local_2'                         => ' ',
    'field_data_ou-periodo_2'               => ' ',
    'field_descritores'                     => 'Federación Latinoamericana de Parasitologos',
    'field_descritores'                     => ' ',
    'field_descritores'                     => ' ',
    'field_descritores'                     => ' ',
    'field_referencia'                      => ' ',
    'field_observacoes'                     => ' ',
]);
$node->save();




////////////////////////////////////////////////////////////////////////////////////////////////////////
//para criar o array vinculado às informações de string do código segunite?

use \Drupal\node\Entity\Node;
$node = Node::create([
  'type'                                => 'arquivos',
  'title'                               => 'Teste com Array',
  'field_fundo'			                    => $array[1][0],
  'field_notacao'		                    => $array[1][1],
  'field_documento'		                  => $array[1][2],
  'field_abordagem'		                  => $array[1][3],
  'field_local_de_producao'	            => $array[1][4],
  'field_data_de_producao'              => $array[1][5],
  'field_tecnica',                      => $array[1][6],
  'field_suporte',                      => $array[1][7],
  'field_formato',                      => $array[1][8],
  'field_cromia',                       => $array[1][9],
  'field_idioma',                       => $array[1][10],
  'field_n_itens',                      => $array[1][11],
  'field_n_exemplares',                 => $array[1][12],
  'field_extensao',                     => $array[1][13],
  'field_responsavel_1',                => $array[1][14],
  'field_tipo_de_responsabilidade_1',   => $array[1][15],
  'field_responsavel_2',                => $array[1][16],
  'field_tipo_de_responsabilidade_2',   => $array[1][17],
  'field_responsaveis_3',               => $array[1][18],
  'field_tipo_de_responsabilidade_3',   => $array[1][19],
  'field_atividade_evento_1',           => $array[1][20],
  'field_especificacao_1',              => $array[1][21],
  'field_local_1',                      => $array[1][22],
  'field_data_ou-periodo_1',            => $array[1][23],
  'field_atividade_evento_2'            => $array[1][24],
  'field_especificacao_2'               => $array[1][25],
  'field_local_2'                       => $array[1][26],
  'field_data_ou-periodo_2'             => $array[1][27],
  'field_descritores',                  => $array[1][28],
  'field_descritores',                  => $array[1][29],
  'field_descritores'                   => $array[1][30],    
  'field_descritores',                  => $array[1][31],
  'field_referencia',                   => $array[1][32],
  'field_observacoes',                  => $array[1][33],
]);
$node->save();


////////////////////////////////////////////////////////////////////////////////////////////////////////
//informações do documento para alimentar os campos do array acima?

[1]=>
  array(5) {
    [0]=>
    string(3) "SBP"
    [1]=>
    string(1) " "
    [2]=>
    string(11) "Certificado"
    [3]=>
    string(9) "Unitária"
    [4]=>
    string(24) "Buenos Aires (Argentina)"
    [5]=>
    string(10) "10/25/1977"
    [6]=>
    string(21) "Impressão, Manuscrita"
    [7]=>
    string(5) "Papel"
    [8]=>
    string(5) "Folha"
    [9]=>
    string(1) " "
    [10]=>
    string(8) "Espanhol"
    [11]=>
    string(1) "1"
    [12]=>
    string(1) "1"
    [13]=>
    string(2) "1f"
    [14]=>
    string(18) "Juan Pablo Bozzini"
    [15]=>
    string(10) "Signatário"
    [16]=>
    string(14) "Pedro Garaguso"
    [17]=>
    string(1) " "
    [18]=>
    string(1) " "
    [19]=>
    string(17) "Homenagem póstuma"
    [20]=>
    string(62) "Membro de honra da Federación Latinoamericana de Parasitologos"
    [21]=>
    string(24) "Buenos Aires (Argentina)"
    [22]=>
    string(8) "10/25/19"
    [23]=>
    string(1) " "
    [24]=>
    string(1) " "
    [25]=>
    string(1) " "
    [26]=>
    string(1) " "
    [27]=>
    string(43) "Federación Latinoamericana de Parasitologos"
    [28]=>
    string(1) " "
    [29]=>
    string(1) " "
    [30]=>
    string(1) " "
    [31]=>
    string(1) " "
    [32]=>
    string(1) " "
    [33]=>
    string(1) " "
  }


////////////////////////////////////////////////////////////////////////////////////////////////////////
//array pop é para pular o elemento 'title'?

$arquivocsv = file_get_contents('/home/aline/caph.csv');
$array = array();

foreach ($lines as $line) {
    $array[] = str_getcsv($line);
}

array_pop($array);

use \Drupal\node\Entity\Node;
foreach($array as $linha) {
	$node = Node::create([
      		'type'        		    	              => 'arquivos',
      		'title'       			                  => $coluna[0],
      		'field_fundo' 			                  => $coluna[1],
      		'field_notacao'			                  => $coluna[2],
      		'field_documento'	    	              => $coluna[3],
      		'field_abordagem'		                  => $coluna[4],
      		'field_local_de_producao'             => $coluna[5],
          'field_data_de_producao'              => $coluna[6]
          'field_tecnica',                      => $coluna[7],
          'field_suporte',                      => $coluna[8],
          'field_formato',                      => $coluna[9],
          'field_cromia',                       => $coluna[10],
          'field_idioma',                       => $coluna[11],
          'field_n_itens',                      => $coluna[12],
          'field_n_exemplares',                 => $coluna[13],
          'field_extensao',                     => $coluna[14],
          'field_responsavel_1',                => $coluna[15],
          'field_tipo_de_responsabilidade_1',   => $coluna[16],
          'field_responsavel_2',                => $coluna[17],
          'field_tipo_de_responsabilidade_2',   => $coluna[18],
          'field_responsaveis_3',               => $coluna[19],
          'field_tipo_de_responsabilidade_3',   => $coluna[20],
          'field_atividade_evento_1',           => $coluna[21],
          'field_especificacao_1',              => $coluna[22],
          'field_local_1',                      => $coluna[23],
          'field_data_ou-periodo_1',            => $coluna[24],
          'field_atividade_evento_2'            => $coluna[25],
          'field_especificacao_2'               => $coluna[26],
          'field_local_2'                       => $coluna[27],
          'field_data_ou-periodo_2'             => $coluna[28],
          'field_descritores',                  => $coluna[29],
          'field_descritores',                  => $coluna[30],
          'field_descritores'                   => $coluna[31],    
          'field_descritores',                  => $coluna[32],
          'field_referencia',                   => $coluna[33],
          'field_observacoes',                  => $coluna[34],
            ]);
            $node->save();
    	]);
   echo $node->save();
    }