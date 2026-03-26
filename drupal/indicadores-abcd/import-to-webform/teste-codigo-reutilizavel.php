<?php

use Drupal\Core\Database\Database;

/*
 * Importação do campo formulario_coleta_de_dados
 * Autor: Anna Valim - 2025
 */

// -----------------------------------------------------------------------------
// CONFIGURAÇÃO
// -----------------------------------------------------------------------------
$webform_ids = [
    'indicadores_abcd_2015', 
    'indicadores_abcd_2016', 
    'indicadores_abcd_2017', 
    'indicadores_abcd_2018', 
    'indicadores_abcd_2019', 
    'indicadores_abcd_2020', 
    'indicadores_abcd_2021', 
    'indicadores_abcd_2022', 
    'indicadores_abcd_2023'
];

$campo_nome = 'formulario_coleta_de_dados';

// -----------------------------------------------------------------------------
// 1. Ler CSV e organizar dados por webform_id → uid → sid_antigo
// -----------------------------------------------------------------------------
$handle = fopen('../../scripts/drupal/indicadores-abcd/data/formulario_coleta_de_dados.csv', 'r');

$cabecalho = fgetcsv($handle);
$dados = [];

while ($linha = fgetcsv($handle)) {
    $linha = array_combine($cabecalho, $linha);

    $webform_id = $linha['webform_id'];
    $uid        = (int) $linha['uid'];
    $sid_antigo = (int) $linha['sid'];

    $dados[$webform_id][$uid][$sid_antigo][] = $linha;
}

fclose($handle);

// -----------------------------------------------------------------------------
// 2. Inserção no banco de dados
// -----------------------------------------------------------------------------
$connection = Database::getConnection();

foreach ($dados as $webform_id => $usuarios) {

    foreach ($usuarios as $uid => $sids_do_usuario) {

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

        // Usuário não tem submissão nesse webform, aceitável
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

    print "✔ Importação concluída para {$webform_id}\n";
}
