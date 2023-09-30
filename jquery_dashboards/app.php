<?php

require_once 'connection.php';
require_once 'dashboard.php';
require_once 'db.php';

use jquery_dashboard\Connection;
use jquery_dashboard\Dashboard;
use jquery_dashboard\Db;

$dashboard = new Dashboard();
$conexao   = new Connection;

$data = $_GET['data'] ?? '';
if(trim($data) != ''){
    $data = explode('-', $data);
    $ano  = $data[0] ?? '';
    $mes  = $data[1] ?? '';

    $diasMes = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);
    $dataInicio = $ano . '-' . $mes . '-01';
    $dataFim    = $ano . '-' . $mes . '-' . $diasMes;

    $dashboard->__set('dataInicio', $dataInicio);
    $dashboard->__set('dataFim', $dataFim);

    $db = new Db($conexao, $dashboard);

    $dashboard->__set('numeroVendas', $db->getNumeroVendas());
    $dashboard->__set('totalVendas', $db->getTotalVendas());
    $dashboard->__set('cAtivos', $db->getClientes(Db::CLIENTE_ATIVO));
    $dashboard->__set('cInativos', $db->getClientes(Db::CLIENTE_INATIVO));
    $dashboard->__set('reclamacoes', $db->getContatos(Db::CONTATO_RECLAMACAO));
    $dashboard->__set('elogios', $db->getContatos(Db::CONTATO_ELOGIO));
    $dashboard->__set('sugestoes', $db->getContatos(Db::CONTATO_SUGESTAO));
    $dashboard->__set('despesas', $db->getDespesas());
} 

echo json_encode($dashboard);


