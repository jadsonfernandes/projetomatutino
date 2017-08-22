<?php

class paginasDAO extends DAO {

    protected $tabela = 'paginas';
    protected $classe = 'Pagina';

    protected function editar(Ientidade &$objeto) {
        $sql = "UPDATE {$this->tabela} SET titulo = :titulo, conteudo = :conteudo WHERE id = :id";

        try{
            
            $editar = $this->con->prepare($sql);
            $editar->bindValue(':titulo', $objeto->getTitulo());
            $editar->bindValue(':conteudo', $objeto->getConteudo());
            $editar->bindValue(':id',$objeto->getId());
            $editar->execute();
            return true; 
            
        } catch (\PDOException $ex) {
            echo "<p>Erro: {$ex->getMessage()}</p>";
        }
    }

    protected function inserir(Ientidade &$objeto) {
        $sql = "INSERT INTO {$this->tabela} (titulo, conteudo,id_categoria) VALUES (:titulo,:conteudo,:id_categoria)";
        try{
            
            
            $inserir = $this->con->prepare($sql);
            $inserir->bindValue(':titulo', $objeto->getTitulo());
            $inserir->bindValue(':conteudo', $objeto->getConteudo());
            $inserir->bindValue(':id_categoria',$objeto->getId_categoria());
            $inserir->execute();
            //Coloco o último id inserido no banco como ID do meu objeto
            $objeto->setId($this->con->lastInsertId());
            return true;
            
        } catch (\PDOException $ex) {
            echo "<p>Erro: {$ex->getMessage()}</p>";
        }
    }

}
