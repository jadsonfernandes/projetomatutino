<?php

class Upload {

    protected $tipospermitidos = ['image/jpeg', 'image/gif', 'image/png'];
    protected $tamanhopermitido = 1024000; // Converte 1mb em Bytes
    protected $pasta = "upload";
    protected $obrigatorio = false;
    protected $arquivo = [];
    protected $mensagem = [];

    public function setObrigatorio($obrigatorio = true) {
        $this->obrigatorio = $obrigatorio;
    }

    protected function adicionaMensagem($mensagem) {
        $this->mensagem[] = $mensagem;
    }

    public function getMensagem() {
        return $this->mensagem;
    }

    function setTipospermitidos(Array $tipospermitidos) {
        $this->tipospermitidos = $tipospermitidos;
    }

    function setTamanhopermitido($tamanhopermitido) {
        $this->tamanhopermitido = $tamanhopermitido;
    }

    function setPasta($pasta) {
        $this->pasta = $pasta;
    }

    function setArquivo($arquivo) {
        if (isset($_FILES[$arquivo])) {
            $this->arquivo['nomeoriginal'] = $_FILES[$arquivo]['name'];
            $this->arquivo['tipo'] = $_FILES[$arquivo]['type'];
            $this->arquivo['temp'] = $_FILES[$arquivo]['tmp_name'];
            $this->arquivo['tamanho'] = $_FILES[$arquivo]['size'];
            $this->arquivo['erro'] = $_FILES[$arquivo]['error'];
        }
    }

    public function existeArquivo() {
        if (count($this->arquivo) && $this->arquivo['erro'] != 4) {
            return true;
        } else {
            return false;
        }
    }

    public function valida() {
        
        
        $erro = 0;

        if(!$this->existeArquivo() && !$this->obrigatorio)
        {
            return true;
        }
        
        if (!$this->existeArquivo() && $this->obrigatorio) {
            $erro++;
            $this->adicionaMensagem("Arquivo não Enviado");
            return false;
        }

        if (!in_array($this->arquivo['tipo'], $this->tipospermitidos)) {
            $erro++;
            $this->adicionaMensagem("Tipo do Arquivo Inválido");
        }

        if ($this->arquivo['tamanho'] > $this->tamanhopermitido) {
            $erro++;
            $this->adicionaMensagem("Tamanho do arquivo maior que o Permitido");
        }

        if ($this->arquivo['erro'] > 0) {
            $erro++;
            $this->adicionaMensagem("Houve um erro interno do Servidor");
        }


        if ($erro == 0) {
            return true;
        } else {
            return false;
        }
    }

    protected function getEndereco($renomear = true, $nome = "") {

        if ($renomear) {
            $ext = strrchr($this->arquivo['nomeoriginal'], '.');

            if ($nome == "") {
                $novonome = md5(rand(1, 10)) . $ext; //Gera um número Aleatório
            } else {
                $novonome = $nome . $ext;
            }
        } else {
            $novonome = $this->arquivo['nomeoriginal'];
        }

        return $this->pasta . "/" . $novonome;
    }

    public function enviar($renomear = true, $nome = "") {
        
        if(!$this->existeArquivo())
        {
            return "";
        }
        
        
        $local = $this->getEndereco($renomear, $nome);

        try {
            move_uploaded_file($this->arquivo['temp'], $local);
            $this->adicionaMensagem("Upload Realizado com Sucesso!");
            return $local;
        } catch (Exception $ex) {
            echo "<p>Erro: {$ex->getMessage()} </p>";
            return false;
        }
    }

}

