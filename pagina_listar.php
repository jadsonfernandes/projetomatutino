<?php
require 'config.php';

$paginasDAO = new PaginasDAO;

$paginas = $paginasDAO->buscar();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <title></title>

    </head>
    <body>

        <div class="container">   
            <h1>Gerenciador de Sites</h1>

            <p>
                <a href="pagina_cadastrar.php" class="btn btn-primary">Nova Página</a>    

            </p>

             <?php
                
             exibe_msg();
             
             ?>

            <table class="table table-bordered">
                <tr>
                    <th>id</th>
                    <th>Titulo</th>
                    <th>Ações</th>
                </tr>
<?php foreach ($paginas as $pagina) { ?>
                    <tr>
                        <td><?= $pagina->getId(); ?></td>
                        <td><?= $pagina->getTitulo(); ?></td>
                        <td> 
                            <a href="pagina_editar.php?id=<?= $pagina->getId() ?>" class="btn btn-warning">Editar</a>
                            <a href="pagina_acao_deletar.php?id=<?= $pagina->getId() ?>" class="btn btn-danger">Excluir</a>

                        </td>
                    </tr>
<?php } ?>
            </table>


        </div>

    </body>
</html>