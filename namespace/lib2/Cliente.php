<?php

namespace Lib2;

class Cliente 
{
    public $_nome = 'Namespace B';

    public function __get($attr)
    {
        return $this->$attr;
    }
}