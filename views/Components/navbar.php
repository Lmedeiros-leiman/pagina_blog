<!DOCTYPE html>
<?php

$filtro = $_GET["pesquisa"] ?? '';
$filtro = str_replace(' ', '',$filtro);

?>


<nav class=" navbar navbar-expand-lg navbar-dark bg-secondary">
    <div class="container-fluid">


        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/dashboard">Dashboard</a>
                </li>
            </ul>
        </div>

        <form class="navbar-text ml-auto " name="form" method="get" action="/" >
            <label>
                <input type="search" name="pesquisa" placeholder="Pesquisar..." value="<?php echo $filtro ?>">
            </label>
                <input type="submit"  value="Search" />
        </form>
        <div class="navbar-text ml-auto">

            <h3>Nome do site</h3>
        </div>



    </div>
</nav>