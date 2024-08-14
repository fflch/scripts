<?php

use Drupal\webform\Entity\Webform;
use Drupal\webform\Entity\WebformSubmission;

// Criado por Anna Valim - 2024
// Para rodar:
// ./vendor/bin/drush php-script ~/repos/scripts/drupal/indicadores-abcd/import-to-webform/import-2023.php

// Passo-a-passo:
// 1. Criar um webform com o nome de máquina: indicadores_abcd
// 2. Na aba build do webform criado, copiar o conteúdo do arquivo: drupal/indicadores-abcd/import-to-webform/import-codigo-fonte.yaml

$csvArchive = fopen('../../scripts/drupal/indicadores-abcd/data/2023.csv', "r");

if ($csvArchive !== FALSE) {
  $anoDeSubmissao = fgetcsv($csvArchive, 1000, ",");
  fgetcsv($csvArchive, 1000, ",");

  while (($data = fgetcsv($csvArchive, 1000, ",")) !== FALSE) {
    if (!$header) {
        $header = $data;
        continue;
    }

    list(
      $usuario,
      $unidade,
      $numero_de_assentos,
      $area_fisica_agrupada,
      $funcionarios_superior,
      $funcionarios_superior_especializacao,
      $funcionarios_superior_mestrado,
      $funcionarios_superior_doutorado,
      $funcionarios_tecnico,
      $funcionarios_basico,
      $superior_eventos,
      $tecnico_eventos,
      $basico_eventos,
      $superior_especializacao,
      $tecnico_especializacao,
      $basico_especializacao,
      $superior_mestrado,
      $tecnico_mestrado,
      $basico_mestrado,
      $superior_doutorado,
      $tecnico_doutorado,
      $basico_doutorado,
      $superior_cursos,
      $tecnico_cursos,
      $basico_cursos,                             
      $coleta_dados_capacitacao, //RESOLVER A QUESTÃO DE IMPORTAÇÃO DOS ARQUIVOS                                
      $filesize_kb,
      $livros_compra_seg_versao,
      $livros_doacao_seg_versao,
      $periodicos_compra_seg_versao,
      $periodicos_doacao_seg_versao,
      $cadastrados_atualmente_periodicos,
      $materiais_nao_cadastrados_periodicos,
      $backlog_catalogacao,
      $usp,
      $externos_usp,
      $consultas_acervo,
      $emprestimos_seg_versao,
      $pedidos_atendidos_nacional_bibliusp,
      $pedidos_atendidos_nacional_comut,
      $pedidos_atendidos_nacional_outros,
      $pedidos_atendidos_internacional,
      $solicitante_atendidos_nacional_bibliusp,
      $solicitante_atendidos_nacional_comut,
      $solicitante_atendidos_nacional_outros,
      $solicitante_atendidos_internacional,
      $assistencias_efetuadas,
      $documento_inteiro,
      $referencias_bibliograficas,
      $equipamentos_usuarios_microcomputador,
      $equipamentos_funcionarios_microcomputador,
      $equipamentos_usuarios_impressora,
      $equipamentos_funcionarios_impressora,
      $equipamentos_usuarios_scanner,
      $equipamentos_funcionarios_scanner,
      $equipamentos_usuarios_outros,
      $equipamentos_funcionarios_outros,
      $bases_de_dados_locais,
      $publicacoes_biblioteca,
      $publicacoes_oficiais_participacao,
      $eventos,
      $projetos,
      $atividades_graduacao,
      $atividades_cultura_extensao,
      $servicos_pela_internet,
      $rede_sem_fio,
      $condicoes_de_acessibilidade,
      $funcionario_treinado_em_libras,
      $banheiros_adaptados,
      $bebedouros_lavabos_adaptados,
      $dimensionamento_entradas_seg_versao,
      $equipamentos_eletronicos_adaptados,
      $espaco_atendimento_adaptado_seg_versao,
      $mobiliario_adaptado_seg_versao,
      $rampa_acesso_adaptada,
      $sinalizacao_tatil,
      $sinalizacao_visual,
      $sinalizacao_sonora,
      $desobstrucao_ambientes_seg_versao,
      $plano_aquisicao_bibliografica_adaptada_seg_versao,
      $acervo_adaptado_seg_versao,
      $websites_apps_adaptados_seg_versao,
      $impressoras_braille_seg_versao,
      $software_leitura_acessivel_seg_versao,
      $teclado_virtual,
    ) = array_slice($data, 8);

    $webform_id = 'indicadores_abcd';
    $webform = Webform::load($webform_id);

    if ($webform) {
      $values = [
        'webform_id' => $webform->id(),
        'data' => [
          'ano_de_submissao' => $anoDeSubmissao[0],
          'usuario' => $usuario,
          'unidade' => $unidade,
          'numero_de_assentos' => $numero_de_assentos,
          'area_fisica_agrupada' => $area_fisica_agrupada,
          'funcionarios_superior' => $funcionarios_superior,
          'funcionarios_superior_especializacao' => $funcionarios_superior_especializacao,
          'funcionarios_superior_mestrado' => $funcionarios_superior_mestrado,
          'funcionarios_superior_doutorado' => $funcionarios_superior_doutorado,
          'funcionarios_tecnico' => $funcionarios_tecnico,
          'funcionarios_basico' => $funcionarios_basico,
          'superior_eventos' => $superior_eventos,
          'tecnico_eventos' => $tecnico_eventos,
          'basico_eventos' => $basico_eventos,
          'superior_especializacao' => $superior_especializacao,
          'tecnico_especializacao' => $tecnico_especializacao,
          'basico_especializacao' => $basico_especializacao,
          'superior_mestrado' => $superior_mestrado,
          'tecnico_mestrado' => $tecnico_mestrado,
          'basico_mestrado' => $basico_mestrado,
          'superior_doutorado' => $superior_doutorado,
          'tecnico_doutorado' => $tecnico_doutorado,
          'basico_doutorado' => $basico_doutorado,
          'superior_cursos' => $superior_cursos,
          'tecnico_cursos' => $tecnico_cursos,
          'basico_cursos' => $basico_cursos,
          'coleta_dados_capacitacao' => $coleta_dados_capacitacao,
          'filesize_kb' => $filesize_kb,
          'livros_compra_seg_versao' => $livros_compra_seg_versao,
          'livros_doacao_seg_versao' => $livros_doacao_seg_versao,
          'periodicos_compra_seg_versao' => $periodicos_compra_seg_versao,
          'periodicos_doacao_seg_versao' => $periodicos_doacao_seg_versao,
          'cadastrados_atualmente_periodicos' => $cadastrados_atualmente_periodicos,
          'materiais_nao_cadastrados_periodicos' => $materiais_nao_cadastrados_periodicos,
          'backlog_catalogacao' => $backlog_catalogacao,
          'usp' => $usp,
          'externos_usp' => $externos_usp,
          'consultas_acervo' => $consultas_acervo,
          'emprestimos_seg_versao' => $emprestimos_seg_versao,
          'pedidos_atendidos_nacional_bibliusp' => $pedidos_atendidos_nacional_bibliusp,
          'pedidos_atendidos_nacional_comut' => $pedidos_atendidos_nacional_comut,
          'pedidos_atendidos_nacional_outros' => $pedidos_atendidos_nacional_outros,
          'pedidos_atendidos_internacional' => $pedidos_atendidos_internacional,
          'solicitante_atendidos_nacional_bibliusp' => $solicitante_atendidos_nacional_bibliusp,
          'solicitante_atendidos_nacional_comut' => $solicitante_atendidos_nacional_comut,
          'solicitante_atendidos_nacional_outros' => $solicitante_atendidos_nacional_outros,
          'solicitante_atendidos_internacional' => $solicitante_atendidos_internacional,
          'assistencias_efetuadas' => $assistencias_efetuadas,
          'documento_inteiro' => $documento_inteiro,
          'referencias_bibliograficas' => $referencias_bibliograficas,
          'equipamentos_usuarios_microcomputador' => $equipamentos_usuarios_microcomputador,
          'equipamentos_funcionarios_microcomputador' => $equipamentos_funcionarios_microcomputador,
          'equipamentos_usuarios_impressora' => $equipamentos_usuarios_impressora,
          'equipamentos_funcionarios_impressora' => $equipamentos_funcionarios_impressora,
          'equipamentos_usuarios_scanner' => $equipamentos_usuarios_scanner,
          'equipamentos_funcionarios_scanner' => $equipamentos_funcionarios_scanner,
          'equipamentos_usuarios_outros' => $equipamentos_usuarios_outros,
          'equipamentos_funcionarios_outros' => $equipamentos_funcionarios_outros,
          'bases_de_dados_locais' => $bases_de_dados_locais,
          'publicacoes_biblioteca' => $publicacoes_biblioteca,
          'publicacoes_oficiais_participacao' => $publicacoes_oficiais_participacao,
          'projetos' => $projetos,
          'eventos' => $eventos,
          'atividades_graduacao' => $atividades_graduacao,
          'atividades_cultura_extensao' => $atividades_cultura_extensao,
          'servicos_pela_internet' => $servicos_pela_internet,
          'rede_sem_fio' => $rede_sem_fio,
          'condicoes_de_acessibilidade' => $condicoes_de_acessibilidade,
          'funcionario_treinado_em_libras' => $funcionario_treinado_em_libras,
          'banheiros_adaptados' => $banheiros_adaptados,
          'bebedouros_lavabos_adaptados' => $bebedouros_lavabos_adaptados,
          'dimensionamento_entradas_seg_versao' => $dimensionamento_entradas_seg_versao,
          'equipamentos_eletronicos_adaptados' => $equipamentos_eletronicos_adaptados,
          'espaco_atendimento_adaptado_seg_versao' => $espaco_atendimento_adaptado_seg_versao,
          'mobiliario_adaptado_seg_versao' => $mobiliario_adaptado_seg_versao,
          'rampa_acesso_adaptada' => $rampa_acesso_adaptada,
          'sinalizacao_tatil' => $sinalizacao_tatil,
          'sinalizacao_visual' => $sinalizacao_visual,
          'sinalizacao_sonora' => $sinalizacao_sonora,
          'desobstrucao_ambientes_seg_versao' => $desobstrucao_ambientes_seg_versao,
          'plano_aquisicao_bibliografica_adaptada_seg_versao' => $plano_aquisicao_bibliografica_adaptada_seg_versao,
          'acervo_adaptado_seg_versao' => $acervo_adaptado_seg_versao,
          'websites_apps_adaptados_seg_versao' => $websites_apps_adaptados_seg_versao,
          'impressoras_braille_seg_versao' => $impressoras_braille_seg_versao,
          'software_leitura_acessivel_seg_versao' => $software_leitura_acessivel_seg_versao,
          'teclado_virtual' => $teclado_virtual,
        ],
      ];

        $webform_submission = WebformSubmission::create($values);
        $webform_submission->save();

    } else {
        echo 'O webform não está disponível ou está com algum erro';
    }
  }

  fclose($csvArchive);

} else {
    echo "Arquivo não disponível ou com falha de carregamento";
}
