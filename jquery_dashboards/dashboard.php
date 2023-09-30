<?php

namespace jquery_dashboard;

class Dashboard 
{
    public $dataInicio;
    public $dataFim;
    public $numeroVendas;
    public $totalVendas;
    public $cAtivos;
    public $cInativos;
    public $reclamacoes;
    public $elogios;
    public $sugestoes;
    public $despesas;

    public function __get($attr)
    {
        return $this->$attr;
    }

    public function __set($attr, $value)
    {
        $this->$attr = $value;

        return $this;
    }

}