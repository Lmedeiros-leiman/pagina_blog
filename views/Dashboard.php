<!doctype html>
<html lang="br">

<?php
require_once "Components/header.php";

$nomeUsuario = "";
if (isset($_POST['USUARIO']) and !empty($_POST['USUARIO']))
{
    $nomeUsuario = $_POST['USUARIO'];
}

?>

<body>
    <header>
        <?php require_once "Components/navbar.php"?>
    </header>



    <div class="contariner " >
        <?php require_once "Components/addItemForm.php"; ?>
    </div>
    <div class="contariner  " style="padding-top: 2rem">
        <?php require_once "Components/interactionForm.php" ?>
    </div>



</body>
</html>








        <?php require_once "Components/footer.php";?>
</body>
</html>