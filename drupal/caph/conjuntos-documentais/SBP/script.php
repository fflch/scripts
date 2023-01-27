<?php
/*
 * script por: Sabrina godoy.
 * 
Suba o drupal na sua máquina local:
No terminal, diretório projetos/drupal, digite o comando:
./vendor/bin/drupal serve -vvv
Acesse o link disponibilizado no terminal, e abrirá o seu drupal local no navegador
No drupal, acesse a ferramenta "estrutura", e selecione "tipo de conteúdo"
clique em "adicionar tipo de conteúdo"
Coloque o título (o que de fato é o título que irá aparecer), depois o rótulo do título
apague o campo "body" que será criado automaticamente
Clique em "adicionar campo"
Selecione o tipo de campo. No caso deste script, consulte a lista abaixo, onde consta o tipo de campo, nome do campo, e o nome de máquina de cada um deles. 
**************** É imprescindível que o nome de máquina seja igual ao da lista!!!!********************************

Tipo de campo     |  Nome de Máquina 

 Texto Simples       'field_notacao'		             
 Texto Simples       'field_documento'	                 
 Texto Simples       'field_abordagem'	                 
 Texto Simples       'field_local_de_producao'           
 Texto Simples       'field_data_de_producao'            
 Texto Listagem      'field_tecnica'  
    adicionar os seguintes itens de listagem desta forma, em configuração do campo:
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

 Texto Simples       'field_suporte'                     
 Texto Listagem      'field_formato' 
    adicionar os seguintes itens de listagem desta forma, em configuração do campo:
    Encadernação|Encadernação
    Folha|Folha
    Fotograma|Fotograma
    Placa|Placa
    Tira|Tira
    
 Texto Listagem      'field_cromia'         
    adicionar os seguintes itens de listagem desta forma, em configuração do campo:
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
 Texto Simples       'field_observacoes'                
 Arquivo             'field_arquivo' 

 Depois de criar todos os tipos de contepudo no drupal, tenha este script baixado na sua máquina, e execute o seguinte comando, considerando o caminho para o seu arquivo de script
Ex.:
./vendor/bin/drush php-script /home/SEU USER/-caminho restante-/script.php
 * 
 * Esse script deve ser rodado como: 
 * ./vendor/bin/drush php-script /home/sabrina/projetos/scripts/drupal/caph/conjuntos-documentais/SBP/script.php
 * 
 * ** para apagar todos os nodes: ./vendor/bin/drupal entity:delete node --all
 * ** para apagar todos os arquivos carregados: ./vendor/bin/drupal entity:delete file --all
 * 
 *  Fase de progresso: pesquisa de código multivalue para o campo descritores.
 * 
 */
use \Drupal\node\Entity\Node;
use \Drupal\file\Entity\File;
// Lendo csv
$arquivocsv = file_get_contents('/home/sabrina/projetos/scripts/drupal/caph/conjuntos-documentais/SBP/SBP.csv');
$arquivos = explode(PHP_EOL, $arquivocsv);
$arquivos_array = array();

foreach ($arquivos as $arquivo) {
    $arquivos_array[] = str_getcsv($arquivo);
}
array_pop($arquivos_array);

// lendo pdfs
$full_path= '/home/sabrina/arquivos_SBP/Acervo Samuel Barnsley Pessoa/';
$arquivospdf= scandir($full_path);

foreach($arquivos_array as $coluna) {
    // lendo pdfs
    $notacao = $coluna[1];
    $arquivos_relacionados = [];
    foreach($arquivospdf as $arquivopdf){
        if(str_contains($arquivopdf, $notacao)){
            $arquivos_relacionados[] = $arquivopdf;
        }
    }
    
	$node = Node::create([
      	'type'          	    	        => 'caph_sbp',
        'uid'                               => 1,
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
        'field_extensao'                    => $coluna[13],
        'field_responsavel_1'               => $coluna[14],
        'field_tipo_de_responsabilidade_1'  => $coluna[15],
        'field_responsavel_2'               => $coluna[16],
        'field_tipo_de_responsabilidade_2'  => $coluna[17],
        'field_responsaveis_'               => $coluna[18],
        'field_tipo_de_responsabilidade_3'  => $coluna[19],
        'field_atividade_evento_1'          => $coluna[20],
        'field_especificacao_1'             => $coluna[21],
        'field_local_1'                     => $coluna[22],
        'field_data_ou_periodo_1'           => $coluna[23],
        'field_atividade_evento_2'          => $coluna[24],
        'field_especificacao_2'             => $coluna[25],
        'field_local_2'                     => $coluna[26],
        'field_data_ou_periodo_2'           => $coluna[27],
       // 'field_descritores_1_'              => $coluna[28],
       // 'field_descritores_2'               => $coluna[29],
       // 'field_descritores_3'               => $coluna[30],    
       // 'field_descritores_4'               => $coluna[31],
        'field_referencia'                  => $coluna[32],
        'field_observacoes'                 => $coluna[33],   
    ]);
    $descritores=[
        ["field_descritores"=> $coluna[28]],
        ["field_descritores"=> $coluna[29]],
        ["field_descritores"=> $coluna[30]],
        ["field_descritores"=> $coluna[31]],
    ];
    $node->set('field_descritores', $descritores);

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
