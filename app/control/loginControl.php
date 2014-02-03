<?php if(!defined('BASEPATH')) exit(header('Location: ./../../index.php'));
/**
 * Description of loginControl
 *
 * @author italo
 */


class login extends controller {   

    public function testelogin(){
     #echo  md5('123');
       /*$ret = $this->verificaUsu('admin','321');
       
       if($ret) var_dump ($ret);
       else echo 'Deu merda!';*/
    }
    private function verificaUsu($login=null,$senha=NULL){
        $senha = md5($senha);
        $ret = crud::consultar(array(
            'login',
            'nome',
            'setor_codigo as setor',
            'tipousuario_idtipousuario',
            'idusuario'
            ),
                'usuario',
                "login='{$login}' AND senha='{$senha}' " );

        if(!empty($ret)){
             return $ret;
            }
        
       
    return FALSE;  
    }
    
    public function validar(){
     
        if(isset($_POST['login']) && $_POST['login']!=NULL &&
           isset($_POST['senha']) && $_POST['senha']!=NULL
         ){
            
            //Garante que não aceite SQL INJECT. 
            //Será adicionada uma barra invertida antes de cada aspa simples e
            //aspa dupla encontrada.
            $login_escape = addslashes($_POST['login']);
            $senha_escape = addslashes($_POST['senha']);
            
            $ret=$this->verificaUsu($login_escape, $senha_escape);
            if($ret){
                
            //var_dump($ret);
            //armazeno os menus que não são actions
            $lista_menu   = crud::consultar(array('(SELECT link FROM menu WHERE idmenu=menu_idmenu AND action=1 ) as link'),
                    'permissao', "usuario_idusuario='{$ret[0]['idusuario']}'");  
            //armazeno os menus que são actions
            $lista_action = crud::consultar(array('(SELECT link FROM menu WHERE idmenu=menu_idmenu AND action=0 ) as link'),
                    'permissao', "usuario_idusuario='{$ret[0]['idusuario']}'");  
         
          foreach ($lista_menu as $key => $value){
                   if($value['link']== NULL)
                       unset($lista_menu[$key]);
                   else{
                     $_lista_menu[] =  crud::consultar(array('nome','link'), 'menu',"link='{$value['link']}'");
                    
                   }
            }
           
            foreach ($_lista_menu as $key => $value){
               
             if($value[0]['link']=='logoff'){
                 $sair = $value;
                 unset($_lista_menu[$key]);
                 array_push($_lista_menu, $sair);
             }    
             
            }
            
            
            foreach ($lista_action as $key => $value){
                   if($value['link']== NULL)
                       unset($lista_action[$key]);
            }
            //apenas para ordenar o array e inicar da posição 0
            foreach ($lista_action as $value){
             $lista_action_ord[] = $value;     
             
            }
            foreach ($_lista_menu as $array){
                if(isset($array[0]['link'])){
                   unset($array[0]['nome']);
                   $lista_action_ord[] = $array[0];
                }
            }
           #echo 'Lista_menu:<br>';
           #var_dump($lista_menu);
           #echo '_Lista_menu:<br>';
           #var_dump($_lista_menu);
           #echo 'Lista_action:<br>';
           #var_dump($lista_action);
           #echo 'Lista_action_ord:<br>';
           #var_dump($lista_action_ord);
           #startSession('session', 1);
            $_SESSION['session'] = array('logado'=>array(
                                              'permissao'=>array( 
                                                                 'menu' => $_lista_menu,
                                                                'action'=> $lista_action_ord
                                                                 ),
                                               'usuario' =>($ret),
                                    'time_limit_session'=> time()
                                                         )
                                        ); 
          
            /*setcookie('session', array('logado'=>
                                      array('permissao'=>array(
                                                                'menu' => $_lista_menu,
                                                               'action'=> $lista_action_ord   
                                          ),
                                             'usuario' =>($ret))
                                        )
               , time()+1800);*/
               
               redirecionar('menu/minhaarea');
             }
           else {
               $_SESSION['msg'] = 'Usuario inválido!';
               redirecionar('index');
           } 
        }
        else  { 
            
            $_SESSION['msg'] = 'Os campos para validação não foram informados!';
            redirecionar('index'); 
        }
    
    }
  
  
    #OK   
    public function alterarsenha(){
       if($_POST['senha'] == $_POST['newsenha']){ 
                $usu = $_SESSION['session']['logado']['usuario'];
                $ret = $this->verificaUsu($usu[0]['login'], $_POST['senhaAt']);
        
        if($ret){
            
            $ret = crud::atualizar('usuario',array('senha'=> md5($_POST['newsenha']) ), "idusuario={$usu[0]['idusuario']}");
           
            if($ret > 0){
              $_SESSION['msg']='Senha alterada com sucesso!';
            }
            else{
              $_SESSION['msg']='Falha na alteração!';  
            }
        }
        else {
            $_SESSION['msg']='Senha inválida!';
        }
       }
      else{
          $_SESSION['msg']='As senhas não conferem!';
      } 
        redirecionar('menu/minhaarea');
        
    }
    
    #ok
    public function alterarlogin(){
       
                $usu = $_SESSION['session']['logado']['usuario'];
                $ret = $this->verificaUsu($usu[0]['login'], $_POST['senhaAt']);
        
        if($ret){
         $ret = crud::consultar(array('login'), 'usuario', "login='{$_POST['newlogin']}'"); 
         if(empty($ret)){
            $ret = crud::atualizar('usuario',array('login'=> $_POST['newlogin'] ), "idusuario={$usu[0]['idusuario']}");
           
            if($ret > 0){
              $_SESSION['msg']='Login alterado com sucesso!';
              $_SESSION['session']['logado']['usuario'][0]['login']= $_POST['newlogin'];
            }
            else{
              $_SESSION['msg']='Falha na alteração!';  
            }
         }
         else
             $_SESSION['msg'] = 'Login já cadastrado!';
        }
        else {
            $_SESSION['msg']='Senha inválida!';
        }
        redirecionar('menu/minhaarea');
    }
    
   
    
}

