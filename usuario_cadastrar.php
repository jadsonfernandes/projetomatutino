<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sistema Gerenciador de Site</title>

        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        
    </head>
    <body>

        <div class="container">   
            <h1>Gerenciador de Sites</h1>
         
            <form method="POST" action="usuario_acao_cadastrar.php" enctype="multipart/form-data">
                    <legend>Usuários</legend>
                
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" id="nome" class="form-control" value=''>
                </div>
                <div class="form-group">
                    <label for="login">Login:</label>
                    <input type="text" name="login" id="login" class="form-control" value=''>
                </div>
                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input type="password" name="senha" id="senha" class="form-control" value=''>
                </div>
                <div class="form-group">
                    <label for="foto">Foto:</label>
                    <input type="file" name="foto" id="foto" class="form-control">
                </div>
                   
                    
                <div>
                    <button name="salvar" class="btn btn-primary">Salvar</button>
                </div>
            </form>


        </div>

        
        
    </body>
</html>