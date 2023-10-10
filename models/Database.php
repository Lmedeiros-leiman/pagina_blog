<?php

namespace models;
use PDO;

class Database
{
    private static $connection = null;

    public static function Query(string $pedido, array $valores = [])
    {
        self::$connection = self::abrirConexao();

        try {
            $stmt = self::$connection->prepare($pedido);

            foreach ($valores as $index => $paramValue) {
                $stmt->bindValue($index + 1, $paramValue);
            }
            $stmt->execute();
            self::fecharConexao();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (\PDOException $e) {
            echo "QUERRY FALHA: " . $e->getMessage();
            self::fecharConexao();
            return false;
        }
    }


    private static function fecharConexao()
    {
        self::$connection = null;
    }

    private static function abrirConexao() : PDO
    {
        if (self::$connection) // already connected
        { return self::$connection; }

        $env = \Application::$EnviromentalVariables;

        $databaseHost = $env["DATABASE_HOST"] ?? "localhost";
        $databaseUser = $env["DATABASE_USER"] ?? 'root';
        $databasePassword = $env["DATABASE_PASSWORD"] ?? '';
        $databaseServer = $env["DATABASE_DATABASE"] ?? 'NONEALLOCATED';
        $databaseDriver = $env["DATABASE_DRIVER"] ?? 'mysql';

        $DSN  = "$databaseDriver:host=$databaseHost;dbname=$databaseServer";

        $pdo = new PDO( $DSN ,$databaseUser,$databasePassword);

        // para evitar problemas:
        self::$connection = $pdo;

        return $pdo;


    }

    public static function CheckTables()
    {
        $tablesExist = self::Query(" SELECT * FROM information_schema.columns WHERE table_name = ? ",["noticias"]);

        if ($tablesExist) { return true; }

        self::Query('CREATE TABLE `sitenoticias`.`noticias` (`ID` INT NOT NULL AUTO_INCREMENT , `titulo` TEXT NOT NULL , `conteudo` TEXT NOT NULL , `horarioPostagem` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP , `NomePostador` VARCHAR(255) NOT NULL , PRIMARY KEY (`ID`)) ENGINE = InnoDB');
        return true;
    }

}