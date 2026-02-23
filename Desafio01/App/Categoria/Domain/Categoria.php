<?php

namespace App\Categoria\Domain;

class Categoria
{
    private string $id;
    private string $name;

    function __construct(string $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(string $id)
    {
        $this->id = $id;
    }

    public function getName():string
    {
        return $this->name;
    }
}