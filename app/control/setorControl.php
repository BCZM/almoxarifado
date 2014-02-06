<?php if(!defined('BASEPATH')) exit(header('Location: ./../../index.php'));
#seguranca_arq();
#sleep(1);
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of setorControl
 *
 * @author italo
 */

class setor extends controller{    
    
    public function __construct() {
        parent::__construct();
    }

   public function alterarnomesetor($setor){
        if(isset($_POST['newname']) && $_POST['newname'] != NULL){
            
            $codigo = addslashes($_POST['newname']);
            $ret = crud::consultar(array('nome'),'setor', "nome='{$codigo}'" );
            if(empty($ret))
            $this->editar(array('nome'=>$_POST['newname']), "idsetor='{$setor[0]['valor']}'");
            else 
               $_SESSION['msg'] = 'Falha: O nome informado já foi cadastrado!';

          }
        else {
            $_SESSION['msg'] = "Novo nome não foi informado!";
          }
     redirecionar('menu/editarsetor/'.$setor[0]['parametro'].'/'.$setor[0]['valor']);
   }
    
    public function alterarcodigosetor($setor){
         if(isset($_POST['newcodigo']) && $_POST['newcodigo'] != NULL){
             $codigo = addslashes($_POST['newcodigo']);
            $ret = crud::consultar(array('codigo'),'setor', "codigo='{$codigo}'" );
            if(empty($ret))
                $this->editar(array('codigo'=>$_POST['newcodigo']), 'idsetor='.$setor[0]['valor']);
            else
                $_SESSION['msg'] = 'Falha: O código informado já foi cadastrado!';
        }
        else {
            $_SESSION['msg'] = "Novo código não foi informado!";   
        }
     redirecionar('menu/editarsetor/codigo/'.$setor[0]['valor']);
   }

    private function editar(array $array,$where){
        var_dump($array);
        var_dump($where);
        $return = crud::atualizar('setor', $array, $where );
        if($return > 0){ 
          $_SESSION['msg'] = "Editado com sucesso!";
        }
    else{ 
         $_SESSION['msg'] = "Falha na edição!";
       }
      redirecionar("menu/setor");
    }
   
    public function deletarsetor($setor){
       $idsetor = addslashes($setor[0]['valor']);
       $ret = crud::consultar(array('nome'), 'usuario', "setor_codigo='{$idsetor}'" );
       if(empty($ret)){
            $return = crud::deletar('setor', "codigo={$setor[0]['valor']}"); 
            if($return > 0){ 
               $_SESSION['msg'] = 'Excluido com sucesso!';
             }
         else{ 
              $_SESSION['msg'] = 'Falha na exclusão!';
            }
       }
       else
           $_SESSION['msg'] = 'Falha: Existe(m) usuário(s) cadastrado(s) no setor!';
       
     redirecionar("menu/setor");
    }
    
    public function cadastrarsetor(){
       if(isset($_POST['nomeSetor']) && $_POST['nomeSetor']!= NULL &&
          isset($_POST['codigoSetor']) && $_POST['codigoSetor']!= NULL){ 
           
       $return = crud::inserir(array('nome' => $_POST['nomeSetor'], 'codigo' => $_POST['codigoSetor']), 'setor');
       if($return > 0){ 
           $_SESSION['msg'] = 'Cadastro realizado com sucesso!';
        }
       else{ 
          $_SESSION['msg'] = 'Falha no cadastro!';
       }
       }
       else {
             $_SESSION['msg'] = 'Falha no cadastro!';    
       }
     redirecionar("menu/setor");
   } 
    
###==============TESTES===============###
        public function teste(){
          $arr  = array(
            'nome' => 'italo',
            'idade' => 22,
            'sexo' => 'masculino'           
        );
       #echo json_encode($arr);
        
       #$setores = crud::consultar(array('*'), 'setor');
       //echo json_encode($setores);
        #var_dump($setores);
    }
}
###=============TESTES================###

