<?php

abstract class DAO {

    protected $tabela;
    protected $classe;
    protected $banco = "projetomatutino";
    protected $usuario = "root";
    protected $senha = "";
    protected $servidor = "localhost";
    protected $con;

    abstract protected function inserir(Ientidade &$objeto);

    abstract protected function editar(Ientidade &$objeto);

    public function __construct() {
        try {

            $dsn = "mysql:host={$this->servidor};dbname={$this->banco};charset=utf8";
            //Instancia um objeto do PDO e salva no atributo con
            $this->con = new \PDO($dsn, $this->usuario, $this->senha);
            //Configura o PDO para utilizar o modo de erro do exception
            $this->con->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $ex) {

            echo "<h3>Não foi possível conectar ao Banco</h3>";
            echo "<p>Erro: {$ex->getMessage()}</p>";
        }
    }

    public function salvar(Ientidade &$objeto) {

        if ($objeto->getId()) {

            return $this->editar($objeto);
        
        } else {

            return $this->inserir($objeto);
        }
    }

    public function deletar(&$id) {

        $sql = "DELETE FROM {$this->tabela} WHERE id = :id";
        try {

            $deletar = $this->con->prepare($sql); //Preparo o sql antes de ser executado
            $deletar->bindValue(":id",$id); //Substituo o coringa pelo valor real
            $deletar->execute(); //Execute o sql que foi preparado
            return $deletar->rowCount();
            
        } catch (\PDOException $ex) {
            echo "<p>Erro: {$ex->getMessage()}</p>";
        }
    }

    public function buscarPorId(&$id) {

        $sql = "SELECT * FROM {$this->tabela} WHERE id = :id";
        try {

            $consulta = $this->con->prepare($sql);
            $consulta->bindValue(":id",$id);
            $consulta->execute();
            return $consulta->fetchObject($this->classe);
        } catch (\PDOException $ex) {
            echo "<p>Erro: {$ex->getMessage()}</p>";
        }
    }

    public function buscar($filtro = "",$dados=[],$todos=true) {

        $sql = "SELECT * FROM {$this->tabela}";
        
        if($filtro){
            $sql .= " WHERE $filtro";
            
            
        }
        
        try {

            $consulta = $this->con->prepare($sql);
            $consulta->execute($dados);
            if($todos){
                
            $dados = $consulta->fetchAll(\PDO::FETCH_CLASS, $this->classe);
            }else{
                $dados = $consulta->fetchObject($this->classe);
            }
        } catch (\PDOException $ex) {
            echo "<p>Erro: {$ex->getMessage()}</p>";
        }

        return $dados;
    }

}
