<?php

namespace jquery_dashboard;

use jquery_dashboard\Dashboard;
use jquery_dashboard\Connection;

class Db 
{
    const CONTATO_RECLAMACAO = 1;
    const CONTATO_SUGESTAO   = 2;
    const CONTATO_ELOGIO     = 3;

    const CLIENTE_ATIVO   = 1;
    const CLIENTE_INATIVO = 0;

    private $conexao;
    private $dashboard;

    public function __construct(Connection $conexao, Dashboard $dashboard)
    {
        $this->conexao = $conexao->connect();
        $this->dashboard = $dashboard;
    }


    public function getNumeroVendas()
    {
        $query = '
            SELECT 
                COUNT(*) AS numero_vendas 
            FROM 
                tb_vendas
            WHERE 
                data_venda between :data_inicio AND :data_fim';

        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':data_inicio', $this->dashboard->__get('dataInicio'));
        $stmt->bindValue(':data_fim', $this->dashboard->__get('dataFim'));
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_OBJ)->numero_vendas;
    }

    public function getTotalVendas()
    {
        $query = '
            SELECT 
                SUM(total) AS total_vendas 
            FROM 
                tb_vendas
            WHERE 
                data_venda between :data_inicio AND :data_fim';

        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':data_inicio', $this->dashboard->__get('dataInicio'));
        $stmt->bindValue(':data_fim', $this->dashboard->__get('dataFim'));
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_OBJ)->total_vendas;
    }

    public function getContatos($tipoContato)
    {
        $query = '
            SELECT 
                COUNT(*) AS contatos
            FROM 
                tb_contatos
            WHERE 
                tipo_contato = :tipo_contato';

        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':tipo_contato', $tipoContato);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_OBJ)->contatos;
    }

    public function getClientes($status)
    {
        $query = '
            SELECT 
                COUNT(*) as clientes
            FROM 
                tb_clientes
            WHERE 
                cliente_ativo = :status';

        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':status', $status);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_OBJ)->clientes;
    }

    public function getDespesas()
    {
        $query = '
            SELECT 
                SUM(total) AS total_desp 
            FROM 
                tb_despesas
            WHERE 
                data_despesa between :data_inicio AND :data_fim';

        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':data_inicio', $this->dashboard->__get('dataInicio'));
        $stmt->bindValue(':data_fim', $this->dashboard->__get('dataFim'));
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_OBJ)->total_desp;
    }

}