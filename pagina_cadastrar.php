<?php

require 'config.php';

$categoriasDAO = new CategoriasDAO();
$categorias = $categoriasDAO->buscar();




$pagina = retornadados('pagina');

if($pagina == ""){
    $pagina = new Pagina();
    
    
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
           
          <?php
          
          exibe_msg();
          
          
          
          
          ?>
          
            <form method="POST" action="pagina_acao_cadastrar.php">
                    <legend>Cadastrar Página</legend>
                
                <div class="form-group">
                    <label for="titulo">Título</label>
                    <input class="form-control" type="text" name="titulo" id="titulo" value="<?=$pagina->getTitulo()?>" >
                </div>
               
               <div class="form-group">
                    <label for="conteudo">Conteúdo</label>
                    <textarea class="form-control" type="textarea" name="conteudo" id="conteudo" ><?=$pagina->getConteudo()?></textarea>
                </div>
              
                    <div class="form_group">
                        <label>Categorias</label>
                        <select name="categoria" class="form-control">
                            <option>Seleciona uma categoria</option>
                            
                            <?php foreach($categorias as $categoria){   ?>
                            <?php
                                if($pagina->getId_categoria() == $categoria->getId()){
                                    $select = "SELECTED";
                                }else{
                                    $select = "";
                                }
                            ?>
                            <option  <?=$select?> value="<?=$categoria->getId()?>">
                            <?=$categoria->getNome()?>
                            
                            </option>
                            
                            <?php }  ?>
                        </select>
                        
                    </div>
                   
               <div class="form-group">
                    <button class="btn btn-success" name="salvar">Salvar</button>
                </div>

            </form>


        </div>

    </body>
</html>