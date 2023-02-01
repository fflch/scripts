<?php
/*
 * script por: Aline Maire.
 * Esse script deve ser rodado como: 
 * ./vendor/bin/drush php-script /home/aline/Git/drupal/scripts/drupal/caph/conjuntos-documentais/JAP/script.php
 * 
 * 
 *  Fase de progresso: pesquisa de comandos para carregar os arquivos PDF's dentro do campo 'arquivo' no node criado.
 * 
 */
use \Drupal\node\Entity\Node;
use \Drupal\file\Entity\File;

//Lendo csv
$arquivocsv = file_get_contents('/home/aline/Git/drupal/scripts/drupal/caph/conjuntos-documentais/JAP/JAP.csv');
$arquivos = explode(PHP_EOL, $arquivocsv);
$arquivos_array = array();

foreach ($arquivos as $arquivo) {
    $arquivos_array[] = str_getcsv($arquivo);
}
array_pop($arquivos_array);

// lendo pdfs
$full_path= '/home/aline/JAP/';
$arquivospdf= scandir($full_path);

foreach($arquivos_array as $campo) {
    // lendo pdfs
    $notacao = $campo[1];
    $arquivos_relacionados = [];
    //var_dump ($notacao);
        foreach($arquivospdf as $arquivopdf){
            if(str_contains($arquivopdf, $notacao)){
            $arquivos_relacionados[] = $arquivopdf;
        }
    }
    //var_dump ($arquivos_relacionados);

    $node = Node::create([
        'type'                              => 'arquivos',
        'uid'                               => 1,
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
        'field_extensao'                    => $campo[13],
/*
        'field_responsavel_1_'              => $campo[15],
        'field_tipo_de_responsabilidade_1'  => $campo[16],
        'field_responsavel_2_'              => $campo[17],
        'field_tipo_de_responsabilidade_2'  => $campo[18],
        'field_responsaveis_3_'             => $campo[19],
        'field_tipo_de_responsabilidade_3'  => $campo[20],
        'field_responsaveis_4_'             => $campo[21],
        'field_tipo_de_responsabilidade_4'  => $campo[22],
        'field_especificacao_1_'            => $campo[24],
        'field_local_1_'                    => $campo[25],
        'field_data_ou_periodo_1_'          => $campo[26],
        'field_atividade_evento_2_'         => $campo[27],
        'field_especificacao_2_'            => $campo[28],
        'field_local_2_'                    => $campo[29],
	'field_data_ou_periodo_2_'          => $campo[30],     
*/
        'field_atividade_evento'            => $campo[23],
        'field_descritores'                 => $campo[31],
        'field_referencia'                  => $campo[32],
        'field_observacoes'                 => $campo[33],
    ]);

    $Responsaveis = [];
    $Responsaveis[] = ['value' => $coluna[14],];
    $Responsaveis[] = ['value' => $coluna[16],];
    $Responsaveis[] = ['value' => $coluna[18],];
    $node->set ('field_responsaveis', $Responsaveis);

    $Tipo_Responsabilidade = [];
    $Tipo_Responsabilidade[] = ['value' => $coluna[15],];
    $Tipo_Responsabilidade[] = ['value' => $coluna[17],];
    $Tipo_Responsabilidade[] = ['value' => $coluna[19],];
    $node->set('field_tipo_de_responsabilidade', $Tipo_Responsabilidade);

    $Arquivos_PDF = [];
    foreach($arquivos_relacionados as $arquivo_relacionado){
        $arquivo_conteudo = file_get_contents($full_path.$arquivo_relacionado);
        $file = file_save_data($arquivo_conteudo, 'public://'.$arquivo_relacionado, FILE_EXISTS_REPLACE);
        $Arquivos_PDF[] = [
            'target_id' => $file->id(),
            'alt'       => 'Arquivo' . $file->id(),
            'title'     => 'JAP PDF',
        ];
    }

    $node->set('field_arquivo', $Arquivos_PDF);

    echo $node->save();
}
