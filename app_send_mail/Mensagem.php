<?php

class Mensagem {

    const STATUS_CODE_SUCCESS = 1;
    const STATUS_CODE_ERROR   = 2;

    private $para = '';

    private $assunto = '';

    private $mensagem = '';

    public $status = array(
        'codigo' => null,
        'mensagem' => ''
    );

    public function __get($attr)
    {
        return $this->$attr;
    }

    public function __set($attr, $value)
    {
        $this->$attr = $value;
    }

    public function isValid()
    {
        if(empty($this->para) || empty($this->assunto) || empty($this->mensagem)){
            return false;
        }

        return true;
    }

}