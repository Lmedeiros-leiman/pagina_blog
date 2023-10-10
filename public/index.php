<!DOCTYPE html>
<?php

require_once "../models/Autoloader.php";
class Application
{
    public static $EnviromentalVariables;
    public function __construct()
    {
        self::$EnviromentalVariables = parse_ini_file('../.env');

        // este comando deveria ser executado uma vez para criar as tabelas e então a aplicação deve assumir que as tabelas existem.
        // mas como é projeto de iniciante...
        \models\Database::CheckTables(); // checa se as tabelas foram criadas, caso não: cria elas.


        // não criarei um roteador avançado.
        // apenas usarei um switch case como roteador básico.
        switch ($_SERVER["REQUEST_URI"])
        {
            case "/dashboard":
                require_once "../views/Dashboard.php";
                break;
            default:
                require_once "../views/Home.php";
                break;
        }


    }
}
$app = new Application();


//
// página inicial: mostra as postagens
//  - mostra todas as postagens de todos os usuários
//  - permite filtrar por tags -> usuário, titulo, texto...
// página dashboard:
//  - lista postagens que o usuário fez
//  - permite adicionar/editar/remover postagens.
//


?>


