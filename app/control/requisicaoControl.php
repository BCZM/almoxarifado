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
    private function adicionarmaterial($id){
       
       if(isset($id['codigo']) && isset($id['categoria'])){
           //$array = array($id[0]['valor'],$id[1]['valor']);
           $flag = FALSE;
           foreach ($_SESSION['cadReq'] as $ls){
               if($ls[0]==$id['codigo']){
                  $flag=TRUE;
                  break;
               }
           }
           if(!$flag){
                $_SESSION['cadReq'][]=  array($id['codigo'],$id['categoria'],$id['descricao'],$id['id'],$id['setor']) ; 
           }
          
          
       } 
    //redirecionar('menu/material');        
    }
    
    private function removermaterial($id){
       $pos = array_search($id, $_SESSION['cadReq'] );
       
        unset($_SESSION['cadReq'][$pos]);
        sort($_SESSION['cadReq']);
        
     //redirecionar('menu/material');        
    }
    
    public function ativarreq(){
        if(!isset($_SESSION['addOn'])){    
            $usuario = $_SESSION['session']['logado']['usuario'][0];
            $_SESSION['addOn'] = date('dmy').$usuario['idusuario'].time() ; //GERAR CODIGO REQUISICAO
        }
        
     redirecionar('menu/material');                  
    }
    private function visualizarDetail(){
        
        if(isset($_GET['codigoReq'])){
       
          $_SESSION['detalhe'] = crud::consultar(array(
                                'qtdsolicitada',
                                'qtdatendida',
                                'status_idstatus',
                                'requisicao_idrequisicao',
                                'material_idmaterial'
                                ), 'requisicao_material',"requisicao_idrequisicao={$_GET['codigoReq']}");
                
            
        }
    }

    public function cadastrarrequisicao(){
        if(isset($_GET['ativarReq'])){
            $this->ativarreq();
        }
        else if(isset($_POST['finalizar'])){
              
            $ret = crud::inserir(array('codigo'=>$_POST['codigoreq'],
                                      'momento'=>  date('Y-m-d H:i:s'),
                            'usuario_idusuario'=>$_POST['usuarioreq']), 
                                                                      'requisicao');
           
            if($ret > 0){ 
                       $ret = crud::consultar(array('idrequisicao as id'), 'requisicao', "codigo={$_POST['codigoreq']}");
                            if(!empty($ret)){
                              $erro = FALSE;  
                             foreach ($_POST['idmaterial'] as $id=>$idmaterial){ 
                                //echo 'Material: '.$idmaterial.' Qtd:'.$_POST['quantidade'][$id].'<br>';
                               $return = crud::inserir(array('qtdsolicitada'=>$_POST['quantidade'][$id],'requisicao_idrequisicao'=>$ret[0]['id'],
                                                     'material_idmaterial'=>$idmaterial),
                                         'requisicao_material');
                                    if($return > 0);
                                    else $erro = TRUE;
                                      
                                        
                               }
                                    if($erro) $_SESSION['msg'] = 'Falha no cadastro!';
                                    else $_SESSION['msg'] = "Requisição de código <strong>{$_POST['codigoreq']}</strong> cadastrada com sucesso!";
                                     
                                    $this->cancelarrequisicao();                                
                            }
                            else
                              $_SESSION['msg'] = 'Falha ao verificar código da requisição!';

                    }
                   else{ 
                      $_SESSION['msg'] = 'Falha no cadastro!';
                   }
        }
        else if(isset($_GET['adicionar']) && isset ($_GET['id']) && isset ($_GET['categoria'])){
           //echo $_GET['id'].' - '.$_GET['categoria'];
            $this->adicionarmaterial(array('codigo'=>$_GET['codigo'],'categoria'=>$_GET['categoria'],'descricao'=>$_GET['descricao'],'id'=>$_GET['id'],'setor'=>$_GET['setor']));
        }
        else if(isset($_GET['remover'])){
            $this->removermaterial($_GET['remover']);
        }
        else if (isset ($_GET['detalhar'])) {
            $this->visualizarDetail();
        }
        else {
            $this->cancelarrequisicao();
        }
     
     redirecionar('menu/material');    
    }
    private function cancelarrequisicao(){
        stopSession('addOn');
        stopSession('cadReq');
        
      //  redirecionar('menu/material');  
    }
    
    public function teste(){
        $ret = crud::consultar(array('idrequisicao'), 'requisicao','codigo=080214291391827388');
        echo $ret[0]['idrequisicao'];
    }
}


