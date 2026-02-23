<?php

namespace App\Categoria\Domain;

class Categoria
{
    private string $id;
    private string $name;

    function __construct(string $name, string $id="")
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function setId(string $id)
    {
        $this->id = $id;
    }

    public function getName():string
    {
        return $this->name;
    }

    public function getId():string
    {
        return $this->id;
    }
}