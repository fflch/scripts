<?php

use Drupal\Core\Database\Database;

/* Criado por Anna Valim - 2025
*
* Passo-a-passo:
* 1. Criar um webform com o nome de máquina: indicadores_abcd_2015
* 2. Na aba build do webform criado, copiar o conteúdo do arquivo: 
*    drupal/indicadores-abcd/import-to-webform/import-codigo-fonte.yaml
* 
* 3. Para rodar e importar os resultados de 2015, insira o código abaixo, atentando para o seu pwd atual:
*    ./vendor/bin/drush php-script ~/projetos/scripts/drupal/indicadores-abcd/import-to-webform/import-2015.php
* 
* 4. Em seguida, rode o código que irá pegar o dados do campo "formulario_coleta_de_dados"
*    ./vendor/bin/drush php-script ~/projetos/scripts/drupal/indicadores-abcd/import-to-webform/import-2015.php
*/

// -----------------------------------------------------------------------------
// 1. Ler CSV e filtrar no $csv_coleta as linhas que são indicadores_abcd_2015, que está na variável $webform_id
// -----------------------------------------------------------------------------
$handle = fopen('../../scripts/drupal/indicadores-abcd/data/formulario_coleta_de_dados.csv', 'r');

$webform_id = 'indicadores_abcd_2015';
$cabecalho = fgetcsv($handle);
$dados = [];

while ($linha = fgetcsv($handle)) {
    $linha = array_combine($cabecalho, $linha);

    if ($linha['webform_id'] !== $webform_id) {
        continue;
    }

    $uid        = (int) $linha['uid'];
    $sid_antigo = (int) $linha['sid'];

    $dados[$uid][$sid_antigo][] = $linha;
}

fclose($handle);

// -----------------------------------------------------------------------------
// 2. Inserção no banco de dados
// -----------------------------------------------------------------------------
$connection = Database::getConnection();

foreach ($dados as $uid => $sids_do_usuario) {

    // Resolver SID novo (1 submissão por usuário/ano)
    $sid_novo = $connection->query(
        "
        SELECT sid
        FROM {webform_submission}
        WHERE webform_id = :webform_id
          AND uid = :uid
        ORDER BY sid ASC
        LIMIT 1
        ",
        [
            ':webform_id' => $webform_id,
            ':uid'        => $uid,
        ]
    )->fetchField();

    // Usuário não tem submissão nesse ano → ignora
    if (!$sid_novo) {
        continue;
    }

    foreach ($sids_do_usuario as $linhas) {

        foreach ($linhas as $linha) {

            // Evitar duplicação
            $exists = $connection->query(
                "
                SELECT 1
                FROM {webform_submission_data}
                WHERE webform_id = :webform_id
                  AND sid = :sid
                  AND name = :name
                  AND property = :property
                  AND delta = :delta
                ",
                [
                    ':webform_id' => $webform_id,
                    ':sid'        => $sid_novo,
                    ':name'       => $campo_nome,
                    ':property'   => $linha['property'],
                    ':delta'      => (int) $linha['delta'],
                ]
            )->fetchField();

            if ($exists) {
                continue;
            }

            $connection->insert('webform_submission_data')
                ->fields([
                    'webform_id' => $webform_id,
                    'sid'        => $sid_novo,
                    'name'       => $campo_nome,
                    'property'   => $linha['property'],
                    'delta'      => (int) $linha['delta'],
                    'value'      => $linha['value'],
                ])
                ->execute();
        }
    }
}

print "Importação concluída para {$webform_id}\n";