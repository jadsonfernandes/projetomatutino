<?php


class Paginas {
    protected $id;
    protected $titulo;
    protected $conteudo;
    protected $id_categoria;
    
    
    public function getId_categoria() {
        return $this->id_categoria;
    }

    public function setId_categoria($id_categoria) {
        $this->id_categoria = $id_categoria;
    }

        function getId() {
        return $this->id;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getConteudo() {
        return $this->conteudo;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setConteudo($conteudo) {
        $this->conteudo = $conteudo;
    }


}
