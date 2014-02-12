<?php  if(!defined('BASEPATH')) exit(header('Location: ./../../index.php'));
#seguranca_arq();
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of usuarioControl 
 *
 * @author italo
 */
class usuario extends controller {
    public function cadastrarusuario(){
        
        if(isset($_POST['nome']) && $_POST['nome']!=NULL &&
           isset($_POST['login']) && $_POST['login']!=NULL &&
           isset($_POST['senha']) && $_POST['senha']!=NULL &&
           $_POST['setor'] != -1 && isset($_POST['permissao'])   
       ){
            $login_escape = addslashes($_POST['login']);
            $ret = crud::consultar(array('login'), 'usuario',"login='{$login_escape}'");
            if(empty($ret)){
             $tipousuario = isset($_POST['adm']) ? '1' : '2';
             $permissao   = $_POST['permissao'];

               $ret = crud::inserir(array('nome'=>$_POST['nome'],'login'=>$login_escape,
                                   'senha'=>  md5($_POST['senha']),'setor_idsetor'=>$_POST['setor'],
                                   'tipousuario_idtipousuario'=>$tipousuario),'usuario');  
               if($ret>0){
                  $ret = crud::consultar(array('idusuario'), 'usuario',"login='{$login_escape}'");
                  foreach ($permissao as $ls){
                       crud::inserir(array('usuario_idusuario'=>$ret[0]['idusuario'],
                                            'menu_idmenu'=>$ls), 'permissao');
                  }
                  $_SESSION['msg'] = 'Cadastro realizado com sucesso!';
               }
               else {
                  $_SESSION['msg'] = 'Falha no cadastro!';    
               }
          }
          else{
              $_SESSION['msg'] = 'Login já foi cadastrado!';    
          }
              
            //codigo para true
        }
        else $_SESSION['msg'] = 'Todos os campos precisam ser informados!';
    
     redirecionar('menu/usuario');
    }
    public function deletarusuario($usuario){
      //exclui primeiro as permissões 
     $return =  crud::deletar('permissao',"usuario_idusuario={$usuario[0]['valor']}" );
       if($return > 0){ 
           //exclui o usuario
            $return = crud::deletar('usuario', "idusuario={$usuario[0]['valor']}"); 
            if($return > 0){ 
               $_SESSION['msg'] = 'Excluido com sucesso!';
             }
            else{ 
              $_SESSION['msg'] = 'Falha na exclusão!';
            }
      }
    else{ 
         $_SESSION['msg'] = 'Falha na exclusão das permissões!';
       }
       redirecionar('menu/usuario');
 }
 private function alterarnomeusuario($id){
     if(isset($_POST['newnome']) && $_POST['newnome'] != NULL ){
         $this->editar(array('nome'=>$_POST['newnome']), "idusuario={$id[0]['valor']}");
     }
     else $_SESSION['msg'] = 'O novo nome precisa ser informado!';
   redirecionar("menu/editarusuario/id/{$id[0]['valor']}");   
 }
 private function alterarloginusuario($id){
     if(isset($_POST['newlogin']) && $_POST['newlogin'] != NULL ){
         $ret = crud::consultar(array('login'), 'usuario', "login='{$_POST['newlogin']}'");
         if(empty($ret)){
              $this->editar(array('login'=>$_POST['newlogin']), "idusuario={$id[0]['valor']}");
         }
         else
             $_SESSION['msg'] = 'Login já cadastrado!';
     }
     else $_SESSION['msg'] = 'O novo login precisa ser informado!';
   redirecionar("menu/editarusuario/id/{$id[0]['valor']}");       
 }
 private function alterarsenhausuario($id){
     if(isset($_POST['newsenha'])&& $_POST['newsenha'] != NULL){
             $this->editar(array('senha'=>md5($_POST['newsenha'])), "idusuario={$id[0]['valor']}");
     }
     else $_SESSION['msg'] = 'A nova senha precisa ser informada!';
    redirecionar("menu/editarusuario/id/{$id[0]['valor']}");       
 }
 private function alterarpermissaousuario($id){
     if(isset($_POST['permissao']) && $_POST['permissao'] != NULL ){
        $permissao = $_POST['permissao'];
        echo $id[0]['valor'];
        print_r($permissao);
        $ret = crud::consultar(array('*'),'permissao', "usuario_idusuario={$id[0]['valor']}");
        if($ret)
              $ret = crud::deletar('permissao', "usuario_idusuario={$id[0]['valor']}");
        
        if($ret > 0 || empty($ret)){
             foreach ($permissao as $ls){
                       crud::inserir(array('usuario_idusuario'=>$id[0]['valor'],
                                            'menu_idmenu'=>$ls), 'permissao');
              }
             $_SESSION['msg'] = 'Permissões alterada com sucesso!';  
        }
        else 
            $_SESSION['msg'] = 'Falha ao excluir as permissões!';
        
      }
   redirecionar("menu/editarusuario/id/{$id[0]['valor']}");             
 }
  private function alteraradm($id){
     if(isset($_POST['tipo'])&& $_POST['tipo'] != NULL){
             $this->editar(array('tipousuario_idtipousuario'=>$_POST['tipo']), "idusuario={$id[0]['valor']}");
     }
     else $_SESSION['msg'] = 'Falha ao informar tipo do usuario!';
    redirecionar("menu/editarusuario/id/{$id[0]['valor']}");       
 }
 private function editar(array $array,$where){
      $return = crud::atualizar('usuario', $array, $where );
        if($return > 0){ 
          $_SESSION['msg'] = "Editado com sucesso!";
        }
    else{ 
         $_SESSION['msg'] = "Falha na edição!";
       }
 }

 public function editarusuario($acao){
     switch ($_GET['acao']){
         case 'alterarlogin':
             $this->alterarloginusuario($acao);
             break;
         case 'alterarperm':
             $this->alterarpermissaousuario($acao);
             break;
         case 'alterarnome':
             $this->alterarnomeusuario($acao);
             break;
         case 'alterarsenha':
             $this->alterarsenhausuario($acao);
             break;
         case 'alteraradm':
             $this->alteraradm($acao);
             break;
     }
 }


###-------------TESTE------------###    
   public function teste(){
       $ret = crud::consultar(array('idusuario'), 'usuario',"login='admin'");
       var_dump($ret);      
   }
###-------------TESTE------------###   
}

