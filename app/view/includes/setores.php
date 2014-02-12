<?php if(!defined('BASEPATH')) exit('Falha no carregamento do BASEPATH!');
  #seguranca_arq();   
        foreach ($val as $array) {
           foreach ($array as $key => $value) {
                   if( $key == 'setores'   ){   $setores = ($value);   
                   break;
                   }
           }         
         } 
         
        $usuario = $_SESSION['session']['logado']['permissao']['action'];  
      $cadastrar = FALSE; 
        $deletar = FALSE; $deletar_txt = ''; 
        $editar  = FALSE; $editar_txt  = '';
      $barra_txt = '';
        foreach ($usuario as $ls){
            if($ls['link']=='cadastrarsetor'){
                $cadastrar = TRUE;
            }
            if($ls['link']=='deletarsetor'){
                $deletar = TRUE;
               }
            if($ls['link']=='editarsetor'){
                $editar = TRUE;
            }   
        } 
?>
<div class="modulo">
<?php
    if($cadastrar):
?>
<a href="#dialog" name="modal" ><img src="<?php echo BARRA.url_base.BARRA.BASEIMAGES?>add_user.png" />Adicionar novo</a>
<div id="dialog" class="window" >
    
    <a href="#" class="close">Fechar [X]</a><br />
    <div class="content_dialog">
    <h3>Inserir setor</h3>
            <form  action="<?php echo BARRA.url_base?>/setor/cadastrarsetor" method="post">
                <div class="pos_center">
                    <p>
                            <strong>Nome do setor</strong><br />
                            <input type="text" name="nomeSetor" value="" width="150px" required="required" />
                    </p>
                    <p>
                            <strong>Sigla do setor</strong><br />
                            <input type="text" name="codigoSetor" value="" width="150px" required="required" />
                    </p>
                    <p>
                        <input type="submit" name="insertS" value="Inserir setor" />
                    </p>
                </div>
            </form>
    </div>
</div>
<?php
    endif;

              if($editar || $deletar){
                  $th_inicio = "<th>";
                  $th_fim    = "</th>";  
                  $td_inicio = "<td class='center'>";
                  $td_fim    = "</td>";
                  $editar_txt    = $editar ? 'Editar' : ''; 
                  $barra_txt     = ($editar && $deletar) ? '/' : ''; 
                  $deletar_txt   = $deletar ? 'Excluir' : ''; 
                }
              else{
                  $th_inicio = '';
                  $th_fim    = '';
                  $td_inicio = '';
                  $td_fim    = '';
              } 
        ?>
	<h3>Listar setores</h3>
        <table cellpadding="0" cellspacing="0" border="0" class="display"  name="datatable">
	<thead>
		<tr>
			<th>Nome</th>
			<th>Código</th>
                        <?php echo 
                            
                                 $th_inicio   
                                .$editar_txt
                                .$barra_txt
                                .$deletar_txt
                                .$th_fim
                            
                         ?>
		</tr>
	</thead>
        <tbody>
        
        <?php            
              foreach ($setores as $ls){
       $deletar_setor = ($deletar) ? "<a href='".BARRA.url_base."/setor/deletarsetor/codigo/{$ls['idsetor']}' onclick=\"return confirm('Deseja realmente excluir o setor ".utf8_encode($ls['nome'])."?');\"  title='Excluir' ><img alt='excluir' src='".BARRA.url_base.BARRA.BASEIMAGES."excluir.png' /></a>":''; 
       $editar_setor  = ($editar)  ? "<a href='".BARRA.url_base."/menu/editarsetor/id/{$ls['idsetor']}' onclick=\"return confirm('Deseja realmente editar o setor ".utf8_encode($ls['nome'])."?');\" title='Editar' ><img alt='editar' src='".BARRA.url_base.BARRA.BASEIMAGES."editar.png' /></a>":'';                     
       
                   echo 
                      "<tr>"
                      ."<td>".utf8_encode($ls['nome'])."</td>"
                      ."<td>".$ls['codigo']."</td>"
                      .$td_inicio
                      .$editar_setor
                      .$deletar_setor
                      .$td_fim
                      ."</tr>"
                              
                  ;
              }
        ?>
         
      </tbody>
</table>
</div>