<?php

class UsuariosDAO extends DAO{
  protected $tabela = "usuarios";
  protected $classe = "Usuario";
    
    protected function editar(\Ientidade &$objeto) {
        $sql = "UPDATE {$this->tabela} SET nome=:nome, login=:login, senha=:senha, foto=:foto WHERE id=:id";
        try{
            
            $editar = $this->con->prepare($sql);
            $editar->bindValue(':nome', $objeto->getNome());
            $editar->bindValue(':login', $objeto->getLogin());
            $editar->bindValue(':senha', $objeto->getSenha());
            $editar->bindValue(':foto', $objeto->getFoto());
            $editar->bindValue(':id',$objeto->getId());
            $editar->execute();
            return true; 
            
        } catch (\PDOException $ex) {
            echo "<p>Erro: {$ex->getMessage()}</p>";
        }
    }

    protected function inserir(\Ientidade &$objeto) {
        $sql = "INSERT INTO {$this->tabela} (nome,login,senha,foto) VALUES (:nome,:login,:senha,:foto)";
        try{
            
            $inserir = $this->con->prepare($sql);
            $inserir->bindValue(':nome', $objeto->getNome());
            $inserir->bindValue(':login', $objeto->getLogin());
            $inserir->bindValue(':senha', $objeto->getSenha());
            $inserir->bindValue(':foto', $objeto->getFoto());
            $inserir->execute();
            //Coloco o último id inserido no banco como ID do meu objeto
            $objeto->setId($this->con->lastInsertId());
            return true;
            
        } catch (\PDOException $ex) {
            echo "<p>Erro: {$ex->getMessage()}</p>";
        }
    }

}
