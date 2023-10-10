<!DOCTYPE html>
<?php

use models\Database;

if (isset($filtro) && !empty($filtro)) {
    for ($i = 1; $i <= 4; $i++) {
        switch ($i) {
            case 1:
                $noticias = Database::Query("SELECT * FROM noticias WHERE horarioPostagem LIKE ?", ["%$filtro%"]);
                break;
            case 2:
                $noticias = Database::Query("SELECT * FROM noticias WHERE NomePostador LIKE ?", ["%$filtro%"]);
                break;
            case 3:
                $noticias = Database::Query("SELECT * FROM noticias WHERE titulo LIKE ?", ["%$filtro%"]);
                break;
            case 4:
                $noticias = Database::Query("SELECT * FROM noticias WHERE conteudo LIKE ?", ["%$filtro%"]);
                break;
        }
        if (!empty($noticias)) {
            break;
        }
    }
} else {
    $noticias = Database::Query("SELECT * FROM noticias");
}

if (empty($noticias)) {
    $noticias = [["titulo" => "SEM POSTAGENS", "NomePostador" => "SISTEMA", "horarioPostagem" => "", "conteudo" => "Volte novamente mais tarde ou seja o primeiro a postar!"]];
}



foreach ($noticias as $noticia)
{
    echo "
        <div>
            <div>$noticia[titulo]</div>
            <div>postado por $noticia[NomePostador] | $noticia[horarioPostagem]</div>
            <pre>$noticia[conteudo]</pre>
        </div>
        ";
}