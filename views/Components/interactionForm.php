<!DOCTYPE html>
<?php
if (isset($_POST['idApagar']) and !empty($_POST['idApagar']))
{
    try {
        \models\Database::Query("delete from noticias where id=?",[$_POST['idApagar']]);
    } catch (PDOException $e)
    {

    }

    unset($_POST['idApagar']);
}


$nomeUsuario = '';
if (isset($_POST['USUARIO']) and !empty($_POST['USUARIO']))
{
    $nomeUsuario = $_POST['USUARIO'];
}
?>
<div class="container overflow-auto" style="max-height: 500px; height: 500px; padding: 2rem;">


            <div class="container">
                <form class="container" method="post" action="/dashboard" name="editform">
                    <label>
                        <input type="text" name="USUARIO" placeholder="Seu nome de usuário" value="<?php echo $nomeUsuario; ?>" />
                    </label> <input type="submit" value="Atualizar tabela">
                </form>
            </div>

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Data publicação</th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Ações</th>
                </tr>
                </thead>
                <tbody>
                <?php

                if ($nomeUsuario)
                {
                    $noticiasUsuario = \models\Database::Query("select * from noticias where NomePostador = ?",[$_POST['USUARIO']]);

                    if ($noticiasUsuario)
                    {
                        foreach ($noticiasUsuario as $noticia)
                        {
                            echo "
                            <tr>
                                <th scope='row'>$noticia[ID]</th>
                                <td>$noticia[horarioPostagem]</td>
                                <td>$noticia[titulo]</td>
                                <td style='display: flex; gap: 0.75rem'>
                                    <button class=' btn btn-primary text-light ' onclick='abrirNoticia($noticia[ID])'>Visualizar</button>
                                    <form method='post' name='deleteForm' action='/dashboard'>
                                        <input type='hidden' name='idApagar' value='$noticia[ID]'>
                                        <input type='hidden' name='USUARIO' value='$_POST[USUARIO]'>
                                        <input class='btn btn-danger text-light'  value='Deletar' type='submit'>
                                    </form>
                                </td>
                            </tr>
                            
                                <dialog id=modal$noticia[ID]>
                                        <button id='cancelBtn' type='button' class='btn btn-danger' onclick='fecharNoticia($noticia[ID])'>Fechar</button>
                                        <h2>$noticia[titulo]</h2>
                                        <p> $noticia[conteudo] </p>
                                </dialog>
                            
                            ";
                        }
                    }
                    else {
                        echo "
                        
                        <tr> 
                            <th scope='row'></th>
                                <td>
                                SEM POSTAGENS DESTA CONTA ENCONTRADAS.
                                </td>
                        </tr>
                        ";
                    }
                }
                ?>

                </tbody>
            </table>
        </div>
<script>

    function abrirNoticia(ID)
    {
        const modal = document.getElementById('modal'+ID);
        modal.showModal();
    }

    function fecharNoticia(ID) {
        const modal = document.getElementById('modal'+ID);
        modal.close();
    }

</script>