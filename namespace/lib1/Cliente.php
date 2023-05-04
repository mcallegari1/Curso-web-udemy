<?php

namespace Lib1;

class Cliente 
{
    public $_nome = 'Namespace A';

    public function __get($attr)
    {
        return $this->$attr;
    }
}