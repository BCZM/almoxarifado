<?php  if(!defined('BASEPATH')) exit(header('Location: ./../../index.php'));
#seguranca_arq();
/**
 * Description of menuControl
 * Serve para carregar exibir as view's
 * @author italo
 */

//echo 'VALOR DA COOKIE: '.$_COOKIE['nomeCookie'];

class menu extends controller {
    
    //variavel $res serve para enviar paramentros de resultados para a view requisitada 
    //o valor dela antes de chegar na view passa pelo arquivo controller.php recebebendo
    //um outro nome de variável, a qual será utilizada dentro da view
    private $res = array();
    private $atr_page;
    function __construct() {
        parent::__construct();
        $this->carregaMenu();
    }

    private function carregaMenu(){
       
         
         
         if(isset($_SESSION['session']['logado'])){
             #echo 'usuario logado!';   
         $permissoes_menu = $_SESSION['session']['logado']['permissao']['menu'];
         #$permissoes_action = $_SESSION['session']['logado']['permissao']['action'];          
         #var_dump($permissoes_menu);
         #var_dump($permissoes_action); 
         $this->res = $permissoes_menu;
         }
         else{
             #echo 'usuario off!';
             

            $this->res = array(
                            array(array('nome'=>'Entrar','link'=>'index')),
                            array(array('nome'=>'Quem somos','link'=>'quemsomos')),
                            array(array('nome'=>'Fale conosco','link'=>'faleconosco'))
                                  
                               );
         }
         
         #var_dump($menus);// $array[0][][nome ou ]
        
         
    }
    
    public function varr(){
        
    }

    //RELACIONADO AO MENU OFFLINE
    public function index(){
        //titulo da pagina
        $this->atr_page['titulo'] = 'AlmoXerife: Login';	
        //classe do controle 
        $this->atr_page['control'] = 'menu/';
        
        $this->res[] = $this->atr_page;
        
       $this->view('inicio', $this->res);  
    }
    public function faleconosco(){
        //titulo da pagina
        $this->atr_page['titulo'] = 'AlmoXerife: Fale conosco';	
        //classe do controle 
        $this->atr_page['control'] = 'menu/';
        
        $this->res[] = $this->atr_page;
       
      $this->view('fale-conosco',  $this->res);    
    }
    public function quemsomos(){
        //titulo da pagina
        $this->atr_page['titulo'] = 'AlmoXerife: Quem somos';	
        //classe do controle 
        $this->atr_page['control'] = 'menu/';
        
        $this->res[] = $this->atr_page;

       $this->view('quem-somos',  $this->res);    
    }
  
   
    
    //RELACIONADO AO MATERIAL
    public function material(){
        //titulo da pagina
        $this->atr_page['titulo'] = 'AlmoXerife: Material';	
        //classe do controle 
        $this->atr_page['control'] = 'menu/';
        
        $this->atr_page['materiais'] =  crud::consultar(array('*'), 'material');
        
        $this->atr_page['grupos'] =  crud::consultar(array('*'), 'categoria');

        
        $this->res[] = $this->atr_page;
       $this->view('material',  $this->res);    
    }
    public function cadastrarmaterial(){
       $this->view('cadastrarmaterial',  $this->res);    
    }
    public function editarmaterial(){
       $this->view('alterarmaterial',  $this->res);    
    }
    
    //RELACIONADO A REQUISIÇÃO
    public function requisicao(){
        $this->view('requisicao', $this->res);
    }
    public function cadastrarrequisicao(){
        $this->view('cadastrarrequisicao', $this->res);
    }
    
    
    //MENU PARA GERENCIAR MATERIAL E REQUISIÇÕES
    public function requisicoes(){
        //titulo da pagina
        $this->atr_page['titulo'] = 'AlmoXerife: Requisições';	
        //classe do controle 
        $this->atr_page['control'] = 'menu/';
        
        $this->res[] = $this->atr_page;
       $this->view('requisicoes',  $this->res);
    }
    
    
    //MENU PARA GERENCIAR SETOR E USUARIO
    public function cliente(){
        //titulo da pagina
        $this->atr_page['titulo'] = 'AlmoXerife: Clientes';	
        //classe do controle 
        $this->atr_page['control'] = 'menu/';
        
        $this->res[] =$this->atr_page;       

       $this->view('clientes',  $this->res);
    }
    
   
    //RELACIONADO AO USUÁRIO
    public function usuario(){//página de listagem de usuários
        //titulo da pagina
        $this->atr_page['titulo'] = 'AlmoXerife: Usuário';	
        //classe do controle 
        $this->atr_page['control'] = 'menu/';
        //carrega usuarios
        $this->atr_page['usuarios'] = crud::consultar(array('login','nome',
            'setor_codigo as setor','idusuario'),'usuario'); 
        //carrega setores
        $this->atr_page['setores'] =  crud::consultar(array('*'), 'setor');
        //carrega menus e actions
        $this->atr_page['menus_actions'] = crud::consultar(array('*'),'menu');

        
        $this->res[] =$this->atr_page;    
        
        $this->view('usuarios', $this->res);
    }
    public function editarusuario($id){//página para edição de usuário 
        
        //titulo da pagina    
        $this->atr_page['titulo'] =  'AlmoXerife: Editar Usuário';
        //classe do controle 
        $this->atr_page['control'] =  'menu/';
        //carrega usuario
        $this->atr_page['usuario'] =  crud::consultar(array(
            'login',
            'nome',
            'setor_codigo as setor',
            'tipousuario_idtipousuario as tipo',
            'idusuario'), 
                'usuario',
                "idusuario='{$id[0]['valor']}'");
        //carrega menus e actions
        $this->atr_page['menus_actions'] = crud::consultar(array('*'), 'menu'); 
        
        //carrega permissoes atribuidas ao usuario        
        $this->atr_page['permissoes'] = crud::consultar(array('menu_idmenu as idmenu',
            'usuario_idusuario as idusuario'),'permissao',"usuario_idusuario={$id[0]['valor']}");
        
            
            
        $this->res[] = $this->atr_page;
        $this->view('alterarusu', $this->res);
    }
    //USUÁRIO ATUAL
    public function minhaarea(){
      
        //titulo da pagina    
        $this->atr_page['titulo'] =  'AlmoXerife: Minha área';
        //classe do controle 
        $this->atr_page['control'] =  'menu/';
   
        $this->res[] = $this->atr_page;
        //$this->carregaMenu();
       
     $this->view('minha-area',  $this->res);
    }
    
    
    //RELACIONADO AO SETOR
    public function setor(){
        //titulo da pagina    
        $this->atr_page['titulo'] =  'AlmoXerife:  Setor';
        //classe do controle 
        $this->atr_page['control'] =  'menu/';
        
        $this->atr_page['setores'] =  crud::consultar(array('*'), 'setor');
        
        $this->res[] = $this->atr_page;
        
        $this->view('setores', $this->res);
    }
   
    public function editarsetor($id){
       
        //titulo da pagina    
        $this->atr_page['titulo'] =  'AlmoXerife: Editar Setor';
        //classe do controle 
        $this->atr_page['control'] =  'menu/';
        
        $this->atr_page['setor'] =  crud::consultar(array('*'), 'setor',"codigo='{$id[0]['valor']}'");
        
        $this->res[] = $this->atr_page;
        $this->view('alterarsetor',  $this->res);
    }
    //RELATÓRIO
    public function relatorio(){
        //titulo da pagina    
        $this->atr_page['titulo'] =  'AlmoXerife: Relatório';
        //classe do controle 
        $this->atr_page['control'] =  'menu/';
        
        $this->res[] = $this->atr_page;
        $this->view('relatorio',  $this->res);
    }


    //ENCERRA CONEXÃO        
    public function logoff(){

        stopSession();        
        $_SESSION['msg'] = 'Logoff realizado com sucesso!';
        redirecionar();
    }
}


