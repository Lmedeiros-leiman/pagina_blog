<?php

namespace models;
class Autoloader
{
    public function __construct()
    {
        spl_autoload_register([$this, 'carregarClasse']);
    }
    private function carregarClasse($clase)
    {
        $classFilePath = __DIR__ ."/../$clase.php";
        return require_once $classFilePath;
    }

}
$autoloader = new Autoloader();