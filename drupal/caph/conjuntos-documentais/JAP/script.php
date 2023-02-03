<?php
/*
 * script por: Aline Maire.
 * 
 * Para subir o drupal em sua máquina local, vá ao terminal, entre no diretório projetos/drupal e insira o seguinte comando:
 ./vendor/bin/drupal serve -vvv
 * 
 * Acesse o link disponibilizado no terminal, para ser encaminhado a interface gráfica do seu drupal local.
 * 
 * Já no drupal, vá em "Estrutura", "Tipo de Conteúdo" e por fim "Adicionar Tipo de Conteúdo."
 * 
 * Insira o título que será exibido, e que irá devivamente aparecer no sistema, e salve.
 * 
 * Apague o coluna$coluna "body" que é criado automaticamente e clique em "Adicionar coluna$coluna", selecionando o tipo de coluna$coluna de acordo com a lista abaixo, onde consta o tipo de coluna$coluna, nome do coluna$coluna, e o nome de máquina de cada um deles.
 * 
 * **************** É imprescindível que o nome de máqina seja igual ao da lista!!!!********************************
 * 
 Tipo de coluna$coluna        |     Nome de Máquina 

 Texto Simples              'field_notacao'		             
 Texto Simples              'field_documento'	                 
 Texto Simples              'field_abordagem'	                 
 Texto Simples              'field_local_de_producao'           
 Texto Simples              'field_data_de_producao'            
 Listagem (texto)           'field_tecnica' 
    Adicione os seguintes itens em ordem alfabética a listagem:
    Cunhagem|Cunhagem
    Datilografia|Datilografia
    Datilografia, Impressão|Datilografia, Impressão
    Datilografia, Impressão, Manuscrita|Datilografia, Impressão, Manuscrita
    Datilografia, Manuscrita|Datilografia, Manuscrita
    Fotografia|Fotografia
    Fotografia analógica|Fotografia analógica
    impressão|impressão
    Impressão, Manuscrita|Impressão, Manuscrita
    Manuscrita|Manuscrita
    Manuscrito|Manuscrito
    Manuscrita, Mimeografia|Manuscrita, Mimeografia
    Mimeografia|Mimeografia
    Mimeografia, Impressão|Mimeografia, Impressão

 Texto Simples              'field_suporte'                     
 Listagem (texto)           'field_formato'
    Adicione os seguintes itens em ordem alfabética a listagem:
    Encadernação|Encadernação
    Folha|Folha
    Fotograma|Fotograma
    Livro|Livro
    Placa|Placa
    Quadro|Quadro
    Tira|Tira

 Listagem (texto)           'field_cromia'
     Adicione os seguintes itens em ordem alfabética a listagem:
    Preto e branco|Preto e branco
    Cores|Cores
    Colorido|Colorido          

 Texto Simples              'field_idioma'                      
 Número Inteiro             'field_numero_de_itens'              
 Número Inteiro             'field_numero_de_exemplares'         
 Texto Simples              'field_extensao_1'
 Texto Simples              'field_extensao_2'                    
 Texto Simples              'field_responsavel_1'               
 Texto Simples              'field_tipo_de_responsabilidade_1'  
 Texto Simples              'field_responsavel_2'               
 Texto Simples              'field_tipo_de_responsabilidade_2'   
 Texto Simples              'field_responsaveis_1'                
 Texto Simples              'field_tipo_de_responsabilidade_3'
 Texto Simples              'field_responsaveis_2'
 Texto Simples              'field_tipo_de_responsabilidade_4' 
 Texto Simples              'field_atividade_evento_1'          
 Texto Simples              'field_especificacao_1'             
 Texto Simples              'field_local_1'                     
 Texto Simples              'field_data_ou_periodo_1'           
 Texto Simples              'field_atividade_evento_2'           
 Texto Simples              'field_especificacao_2'             
 Texto Simples              'field_local_2'                     
 Texto Simples              'field_data_ou_periodo_2'           
 Texto Simples              'field_descritores'               
 Texto Simples              'field_referencia'                  
 Texto (simples,longo)      'field_observacoes'
 Arquivo                    'field_arquivo' 
 *
 * Após a criação de todos os tipos de conteúdo no drupal, tenha este script baixado na sua máquina, e execute o seguinte comando, considerando o caminho para o seu arquivo de script.
 * 
 * Ex.:
./vendor/bin/drush php-script /home/SEU USER/-caminho restante-/script.php
*
--------------------------------------------------------------------------------------------
 * Esse script deve ser rodado como: 
 * ./vendor/bin/drush php-script /home/aline/Git/drupal/scripts/drupal/caph/conjuntos-documentais/JAP/script.php
 * 
 * ** Para apagar todos os nodes: ./vendor/bin/drupal entity:delete node --all
 * ** Para apagar todos os arquivos carregados: ./vendor/bin/drupal entity:delete file --all
 * 
 *  Fase de progresso: pesquisa de código multivalue para o coluna$coluna descritores.
 * 
 */
use \Drupal\node\Entity\Node;
use \Drupal\file\Entity\File;

$home_dir = "/home/acesarfs/";
//Lendo csv
$arquivocsv = file_get_contents($home_dir . 'Git/drupal/scripts/drupal/caph/conjuntos-documentais/JAP/JAP.csv');
$arquivos = explode(PHP_EOL, $arquivocsv);
$arquivos_array = array();

foreach ($arquivos as $arquivo) {
    $arquivos_array[] = str_getcsv($arquivo);
}
array_pop($arquivos_array);

// Caminho para leitura dos PDF's
$full_path= $home_dir . 'JAP/';
$arquivospdf= scandir($full_path);

foreach($arquivos_array as $coluna) {
    // Lendo PDF's
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
        'field_acervo'                      => 'JAP',
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
        'field_numero_de_itens'             => $coluna[11],
        'field_numero_de_exemplares'        => $coluna[12],
//      'field_extensao_1'                  => $coluna[13],
//      'field_extensao_2'                  => $coluna[14],
//        'field_responsavel_1'               => $coluna[15],
//        'field_tipo_de_responsabilidade_1'  => $coluna[16],
//        'field_responsavel_2'               => $coluna[17],
 //       'field_tipo_de_responsabilidade_2'  => $coluna[18],
//        'field_responsaveis_1'              => $coluna[19],
//        'field_tipo_de_responsabilidade_3'  => $coluna[20],
//        'field_responsaveis_2'              => $coluna[21],
 //       'field_tipo_de_responsabilidade_4'  => $coluna[22],
//        'field_atividade_evento'            => $coluna[23],
 //       'field_especificacao_1'             => $coluna[24],
 //       'field_local_1'                     => $coluna[25],
//      'field_data_ou_periodo_1'           => $coluna[26],
 //       'field_atividade_evento_2'          => $coluna[27],
//        'field_especificacao_2'             => $coluna[28],
 //       'field_local_2'                     => $coluna[29],
//      'field_data_ou_periodo_2'           => $coluna[30],
 //       'field_descritores'                 => $coluna[31],
        'field_referencia'                  => $coluna[32],
        'field_observacoes'                 => $coluna[33],
    ]);
    
//  Realizei a inserção desse coluna$coluna, pois na planilha do JAP existem dois coluna$colunas para Extensão.
    $Extensao   = [];
    $Extensao[] = ['value' => $coluna[13],];
    $Extensao[] = ['value' => $coluna[14],];
    $node->set('field_extensao', $Extensao);

    $Data_Periodo   = [];
    $Data_Periodo[] = ['value' => $coluna[26],];
    $Data_Periodo[] = ['value' => $coluna[30],];
    $node->set('field_data_ou_periodo', $Data_Periodo);

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

    $Local = [];
    $Local [] = ['value' => $coluna[22]];
    $Local [] = ['value' => $coluna[26]];
    $node->set('field_local', $Local);

    $Especificacao = [];
    $Especificacao[] = ['value' => $coluna[21]];
    $Especificacao[] = ['value' => $coluna[25]];
    $node->set('field_especificacao', $Especificacao);

    $Atividade_Evento = [];
    $Atividade_Evento[] = ['value' => $coluna[20]];
    $Atividade_Evento[] = ['value' => $coluna[24]];
    $node->set('field_atividade_evento', $Atividade_Evento);

    $Descritores = [];
    $Descritores[] = ['value' => $coluna[28]];
    $Descritores[] = ['value' => $coluna[29]];
    $Descritores[] = ['value' => $coluna[30]];
    $Descritores[] = ['value' => $coluna[31]];
    $node->set('field_descritores', $Descritores);

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
