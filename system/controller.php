<?php if(!defined('BASEPATH')) exit('Falha no carregamento do script!');
    
/**
 * Description of controller
 *
 * @author italo
 */
require_once (BASESYSTEM.'configDB.php');


class controller extends configDB{
//variável $val é utilizada para passar parâmetros para a view requisitada
    protected function view( $nameView, array $val = array() ){
         require_once (BASEVIEWINC.$nameView.'.php');        
        exit();
    }
  	
    
}

