<?php if(!defined('BASEPATH')) exit(header('Location: ./../../index.php'));

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of requisicaoControl
 *
 * @author italo
 */


//session_start();

class requisicao extends controller {
    //put your code here
    public function adicionarmaterial($id){
       
       if(isset($id[0]['valor']) && isset($id[1]['valor'])){
           //$array = array($id[0]['valor'],$id[1]['valor']);
           $flag = FALSE;
           foreach ($_SESSION['cadReq'] as $ls){
               if($ls[0]==$id[0]['valor']){
                  $flag=TRUE;
                  break;
               }
           }
           if(!$flag){
                $_SESSION['cadReq'][]=  array($id[0]['valor'],$id[1]['valor']) ; 
           }
          
          
       } 
    redirecionar('menu/material');        
    }
    
    public function removermaterial($id){
       $pos = array_search($id[0]['valor'], $_SESSION['cadReq'] );
       
        unset($_SESSION['cadReq'][$pos]);
        sort($_SESSION['cadReq']);
        
     redirecionar('menu/material');        
    }
    
    public function ativarreq(){
          $_SESSION['addOn']=TRUE;
    
     redirecionar('menu/material');                  
    }
}


