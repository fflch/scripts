<?php
/*
 * script por: Sabrina Godoy
 *
No terminal, diretório do projeto do Drupal, digite: ./vendor/bin/drupal serve -vvv
Acesse o link do site, geralmente http://127.0.0.1:8088/, no navegador
No site, acesse Estrutura > Tipos de conteúdo
Clique em Adicionar tipo de conteúdo e preencha os dados obrigatórios
Em Gerenciar campos, apague o campo Body
Clique em + Adicionar campo para cada um dos campos abaixo de acordo com o tipo e o nome de máquina

Tipo de coluna$coluna        |     Nome de Máquina

Texto Simples      'field_notacao'
Texto Simples      'field_documento'
Texto Simples      'field_abordagem'
Texto Simples      'field_local_de_producao'
Texto Simples      'field_data_de_producao'

Texto Listagem     'field_tecnica'
Adicione os seguintes itens em ordem alfabética:
    Datilografia|Datilografia
    Datilografia, Impressão|Datilografia, Impressão
    Datilografia, Impressão, Manuscrita|Datilografia, Impressão, Manuscrita
    Datilografia, Manuscrita|Datilografia, Manuscrita
    Fotografia analógica|Fotografia analógica
    impressão|impressão
    Impressão, Manuscrita|Impressão, Manuscrita
    Manuscrita|Manuscrita
    Manuscrita, Mimeografia|Manuscrita, Mimeografia
    Mimeografia|Mimeografia
    Mimeografia, Impressão|Mimeografia, Impressão




Texto Simples      'field_suporte'

Texto Listagem     'field_formato'
Adicione os seguintes itens em ordem alfabética:
    Encadernação|Encadernação
    Folha|Folha
    Fotograma|Fotograma
    Placa|Placa
    Tira|Tira



Texto Listagem       'field_cromia'
Adicione os seguintes itens em ordem alfabética:
    Cores|Cores
    Preto e Branco|Preto e Branco


Texto Simples       'field_idioma'
Número Inteiro      'field_numero_de_itens'
Número Inteiro      'field_numero_de_exemplares'
Texto Simples       'field_extensao'

Texto Simples       'field_responsavel_1'
Texto Simples       'field_tipo_de_responsabilidade_1'
Texto Simples       'field_responsavel_2'
Texto Simples       'field_tipo_de_responsabilidade_2'
Texto Simples       'field_responsaveis_'
Texto Simples       'field_tipo_de_responsabilidade_3'

 

Texto Simples       'field_atividade_evento_1'
Texto Simples       'field_especificacao_1'
Texto Simples       'field_local_1'
Texto Simples       'field_data_ou_periodo_1'

Texto Simples       'field_atividade_evento_2'
Texto Simples       'field_especificacao_2'
Texto Simples       'field_local_2'
Texto Simples       'field_data_ou_periodo_2'

Texto Simples       'field_descritores_1_'
Texto Simples       'field_descritores_2'
Texto Simples       'field_descritores_3'
Texto Simples       'field_descritores_4'
Texto Simples       'field_referencia'
Texto (simples,longo)       'field_observacoes'
Arquivo             'field_arquivo'

Execute o seguinte comando, considerando o caminho para o seu arquivo de script: ./vendor/bin/drush php-script /home/SEU USER/-caminho restante-/script.php
Ex.: ./vendor/bin/drush php-script /home/acesarfs/projetos/scripts/drupal/caph/conjuntos-documentais/SBP/script.php
 *
 * ** Para apagar todos os nodes:    ./vendor/bin/drupal entity:delete node --all
 * ** Para apagar todos os arquivos: ./vendor/bin/drupal entity:delete file --all
 *
 *  Fase de progresso: pesquisa de código multivalue para o coluna$coluna descritores.
 *
 */
use \Drupal\node\Entity\Node;
use \Drupal\file\Entity\File;

$home_dir = "/home/acesarfs/";
$arquivocsv = file_get_contents($home_dir . 'projetos/scripts/drupal/caph/conjuntos-documentais/SBP/SBP.csv');
$arquivos = explode(PHP_EOL, $arquivocsv);
$arquivos_array = array();

foreach ($arquivos as $arquivo) {
    $arquivos_array[] = str_getcsv($arquivo);
}
array_pop($arquivos_array);

$full_path = $home_dir . 'arquivos_SBP/';
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
        'type'                              => 'acervo_caph',
        'uid'                               => 1,
        'field_acervo'                      => 'SBP',
        'title'      		                => $coluna[0],
        'field_notacao'		                => $coluna[1],
        'field_documento'	                => $coluna[2],
        'field_abordagem'	                => $coluna[3],
        'field_local_de_producao'           => $coluna[4],
        'field_data_de_producao'            => $coluna[5],
        'field_tecnica'                     => $coluna[6],
        'field_suporte'                     => $coluna[7],
        'field_formato'                     => $coluna[8],
        'field_cromia'                      => $coluna[9],
        'field_idioma'                      => $coluna[10],
        'field_numero_de_itens'             => $coluna[11],
        'field_numero_de_exemplares'        => $coluna[12],
        'field_referencia'                  => $coluna[32],
        'field_observacoes'                 => $coluna[33],
    ]);

    $Extensao   = [];
    $Extensao[] = ['value' => $coluna[13],];
    $node->set('field_extensao', $Extensao);

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

    $Atividade_Evento = [];
    $Atividade_Evento[] = ['value' => $coluna[20]];
    $Atividade_Evento[] = ['value' => $coluna[24]];
    $node->set('field_atividade_evento', $Atividade_Evento);

    $Especificacao = [];
    $Especificacao[] = ['value' => $coluna[21]];
    $Especificacao[] = ['value' => $coluna[25]];
    $node->set('field_especificacao', $Especificacao);

    $Local = [];
    $Local [] = ['value' => $coluna[22]];
    $Local [] = ['value' => $coluna[26]];
    $node->set('field_local', $Local);

    $Data_Periodo   = [];
    $Data_Periodo[] = ['value' => $coluna[23],];
    $Data_Periodo[] = ['value' => $coluna[27],];
    $node->set('field_data_ou_periodo', $Data_Periodo);
    
    $Descritores = [];
    $Descritores[] = ['value' => $coluna[28]];
    $Descritores[] = ['value' => $coluna[29]];
    $Descritores[] = ['value' => $coluna[30]];
    $Descritores[] = ['value' => $coluna[31]];
    $node->set('field_descritores', $Descritores);

    $Arquivos_PDF = [];
    foreach($arquivos_relacionados as $arquivo_relacionado) {
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
