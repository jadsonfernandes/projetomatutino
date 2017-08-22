<?php


class Usuario implements Ientidade {
    
    protected $id;
    protected $nome;
    protected $login;
    protected $senha;
    protected $foto;
    protected $logado = false;
    
    public function getLogado() {
        return $this->logado;
    }

        
    function getNome() {
        return $this->nome;
    }

    function getLogin() {
        return $this->login;
    }

    function getSenha() {
        return $this->senha;
    }

    function getFoto() {
        return $this->foto;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setSenha($senha) {
        $this->senha = password_hash($senha, PASSWORD_DEFAULT);
    }

    function setFoto($foto) {
        $this->foto = $foto;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function login($senha){
        
        if(password_verify($senha,$this->senha)){
            $this->logado = true;
            $_SESSION['usuariologado'] = $this;
            return true;
            
        }else{
            return false;
        }
        
    }
    
}
