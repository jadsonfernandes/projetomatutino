<?php
    require 'config.php';
    
    $id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);
    
    if($id){
        
        $paginasDAO = new PaginasDAO;
        $pagina = $paginasDAO->buscarPorId($id);
        
    }
    
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>
        <link href="css/bootstrap.min.css" rel="stylesheet">

    </head>
    <body>

        <div class="container">   
            
          <h1>Gerenciador de Sites</h1>
          <?php  exibe_msg(); ?>

            <form method="POST" action="pagina_listar.php?id=<?=$pagina->getId()?>">
                    <legend>Editar Página</legend>
                    <fieldset>
                <div class="form-group">
                    <label for="titulo">Título</label>
                    <input class="form-control" type="text" name="titulo" id="titulo" value="<?=$pagina->getTitulo()?>" >
                </div>
               
               <div class="form-group">
                    <label for="conteudo">Conteúdo</label>
                    <textarea class="form-control" type="textarea" name="conteudo" id="conteudo" ><?=$pagina->getConteudo()?></textarea>
                </div>
              
               <div class="form-group">
                    <button class="btn btn-success" name="salvar">Salvar</button>
                </div>
                    </fieldset>
            </form>


        </div>

    </body>
</html>