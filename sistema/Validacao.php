<?php


 
class Validacao {
   protected $erro = 0;
   protected $mensagem = [];
   
   public function getMensagem() {
       return $this->mensagem;
   }

   protected function setMensagem($mensagem) {
       $this->mensagem[] = $mensagem;
   }

   public function obrigatorio($campo,$valor){
       
       if($valor == ""){
           $this->setMensagem("O campo $campo deve ser Preenchido!");
           $this->erro++;
       }
       
   }
   
   public function valida(){
       
       if($this->erro > 0){   
           return false;
           
       }
       else{
           return true;
       }
       
    }
   
}
