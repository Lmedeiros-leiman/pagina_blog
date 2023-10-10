<!DOCTYPE html>
<?php
$nomeUsuario = '';
if (isset($_POST['USUARIO']) and !empty($_POST['USUARIO'])) {
    $nomeUsuario = $_POST['USUARIO'];

}

if (isset($_POST["TITULO"]) and !empty($_POST["TITULO"]) )
{
    $pedido = "insert into noticias (`ID`, `titulo`, `conteudo`, `horarioPostagem`, `NomePostador`) VALUES (?,?,?,CURRENT_TIMESTAMP,?)";
    $valores = [null,$_POST["TITULO"],$_POST["CONTEUDO"] ,$_POST["USUARIO"]];
    \models\Database::Query($pedido,$valores);
}



?>

<form method="post" action="/dashboard" class="container" style="padding-top: 2rem">
    <div class="mb-3">
        <label for="NomeUsuario" class="form-label">Nome Usuario</label>
        <input required type="text" class="form-control" name="USUARIO" id="NomeUsuario" value='<?php echo $nomeUsuario ?>' placeholder="Nome usuario">
    </div>
    <div class="mb-3">
        <label for="TituloPostagem" class="form-label">Titulo da postagem</label>
        <input required type="text" class="form-control" name="TITULO" id="TituloPostagem" placeholder="Titulo">
    </div>
    <div class="mb-3">
        <label for="ConteudoPostagem" class="form-label">Conteudo Postagem</label>
        <textarea required class="form-control" name="CONTEUDO" id="ConteudoPostagem" rows="3" placeholder="Conteudo Postagem aqui..." ></textarea>
    </div>
    <input type="submit" class='btn btn-primary text-light' value="Postar" />
</form>
