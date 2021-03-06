<?php if(!defined('BASEPATH')) exit(header('Location: ./../../index.php'));

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of materialControl
 *
 * @author italo
 */
  
class material extends controller {
    //put your code here
    public function cadastrarmaterial(){
        if(isset($_POST['grupoMaterial']) && isset($_POST['codigoMaterial'])
                && isset($_POST['detalheMaterial']) && $_POST['grupoMaterial']!=NULL 
                && $_POST['codigoMaterial'] !=NULL && $_POST['detalheMaterial']!=NULL){
               
                $codigo = $_POST['codigoMaterial'];
                        $ret = crud::consultar(array('idmaterial'),'material', "idmaterial='{$codigo}'" );
                 if(empty($ret)){
                   $return =  crud::inserir(array('codigo'=>$codigo,'nome'=>$_POST['detalheMaterial'],
                                            'categoria_idcategoria'=>$_POST['grupoMaterial']), 'material');
                       if($return > 0){ 
                            $_SESSION['msg'] = 'Cadastro realizado com sucesso!';
                         }
                        else{ 
                           $_SESSION['msg'] = 'Falha no cadastro!';
                        }
                 }
                 else
                  $_SESSION['msg'] = 'Falha: O código informado já foi cadastrado!';
                 
                 
            }
            redirecionar('menu/material');  
    }
    
    public function detalhematerial(){
        if(isset($_GET['codigoMaterial']) && $_GET['codigoMaterial']!=NULL){
             $ret = crud::consultar(array('codigo','nome','data_ultima_entrada','data_ultima_saida',
                'qtd_ultima_entrada','qtd_ultima_saida','qtd_atual',
                '(SELECT codigo FROM categoria WHERE idcategoria=categoria_idcategoria) as categoria',
                '(SELECT codigo FROM situacao WHERE idsituacao=situacao_idsituacao) as situacao',
                'idmaterial'
                ),
                    
                    'material',"idmaterial={$_GET['codigoMaterial']}");
            
            if(!empty($ret)){
               $_SESSION['detalhe'] = $ret; 
            }
            else 
               $_SESSION['msg'] = 'Falha: O código não encontrado!';

        }
      redirecionar('menu/material');  
    }

    public function editarmaterial(){
         if(isset($_GET['codigoMaterial']) && $_GET['codigoMaterial']!=NULL){
            $ret = crud::consultar(array('codigo','nome','data_ultima_entrada','data_ultima_saida',
                'qtd_ultima_entrada','qtd_ultima_saida','qtd_atual',
                '(SELECT codigo FROM categoria WHERE idcategoria=categoria_idcategoria) as categoria',
                '(SELECT codigo FROM situacao WHERE idsituacao=situacao_idsituacao) as situacao',
                'idmaterial'
                ),
                    
                    'material',"idmaterial={$_GET['codigoMaterial']}");
            
            if(!empty($ret)){
               $_SESSION['editar'] = $ret; 
            }
            else 
               $_SESSION['msg'] = 'Falha: O código não encontrado!';

        }
      redirecionar('menu/material');  
    }
}

