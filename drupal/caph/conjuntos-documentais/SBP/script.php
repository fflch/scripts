<?php
/*
 * script por: Sabrina godoy.
 * Esse script deve ser rodado como: 
 * ./vendor/bin/drush php-script /home/sabrina/projetos/scripts/drupal/caph/conjuntos-documentais/SBP/script2.php
 * 
 * 
 *  Fase de progresso: pesquisa de comandos para carregar os arquivos PDF's dentro do campo 'arquivo' no node criado.
 * 
 */
use \Drupal\node\Entity\Node;
use \Drupal\file\Entity\File;

$arquivocsv = file_get_contents('/home/acesarfs/projetos/scripts/drupal/caph/conjuntos-documentais/SBP/SBP.csv');
$arquivos   = explode(PHP_EOL, $arquivocsv);
$arquivos_array = array();
foreach ($arquivos as $arquivo) {
    $arquivos_array[] = str_getcsv($arquivo);
}
array_pop($arquivos_array);

$full_path = '/home/acesarfs/arquivos_sbp/';
$arquivospdf = scandir($full_path);
foreach($arquivos_array as $coluna) {
    $notacao = $coluna[1];
    $arquivos_relacionados = [];
    foreach($arquivospdf as $arquivopdf){
        if(str_contains($arquivopdf, $notacao)){
            $arquivos_relacionados[] = $arquivopdf;
        }
    }
       
	$node = Node::create([
      	'type'                              => 'caph_sbp',
        'uid'                               => 1,
        'title'                             => $coluna[0],
        'field_notacao'                     => $coluna[1],
        'field_documento'                   => $coluna[2],
        'field_abordagem'                   => $coluna[3],
        'field_local_de_producao'           => $coluna[4],
        'field_data_de_producao'            => $coluna[5],
        'field_tecnica'                     => $coluna[6],
        'field_suporte'                     => $coluna[7],
        'field_formato'                     => $coluna[8],
        'field_cromia'                      => $coluna[9],
        'field_idioma'                      => $coluna[10],
        'field_n_itens'                     => $coluna[11],
        'field_n_exemplares'                => $coluna[12],
        'field_extensao'                    => $coluna[13],
        'field_responsavel_1'               => $coluna[14],
        'field_tipo_de_responsabilidade_1'  => $coluna[15],
        'field_responsavel_'                => $coluna[16],
        'field_tipo_de_responsabilidade_'   => $coluna[17],
        'field_responsaveis_'               => $coluna[18],
        'field_tipo_de_responsabilidade_3'  => $coluna[19],
        'field_atividade_evento_1'          => $coluna[20],
        'field_especificacao_1'             => $coluna[21],
        'field_local_1'                     => $coluna[22],
        'field_data_ou_periodo_1'           => $coluna[23],
        'field_atividade_evento_'           => $coluna[24],
        'field_especificacao_2'             => $coluna[25],
        'field_local_2'                     => $coluna[26],
        'field_data_ou_periodo_2'           => $coluna[27],
        'field_descritores_1_'              => $coluna[28],
        'field_descritores_2'               => $coluna[29],
        'field_descritores_3'               => $coluna[30],    
        'field_descritores_4'               => $coluna[31],
        'field_referencia'                  => $coluna[32],
        'field_observacoes'                 => $coluna[33],   
    ]);

    $Arquivos_PDF = [];
    foreach($arquivos_relacionados as $arquivo_relacionado){
        $arquivo_conteudo = file_get_contents($full_path.$arquivo_relacionado);
        $file = file_save_data($arquivo_conteudo, 'public://'.$arquivo_relacionado, FILE_EXISTS_REPLACE);
        $Arquivos_PDF[] = [
            'target_id' => $file->id(),
            'alt'       => 'Arquivo' . $file->id(),
            'title'     => 'SBP PDF',
        ];
    }

    $node->set('field_arquivo', $Arquivos_PDF);
    echo $node->save();
}
