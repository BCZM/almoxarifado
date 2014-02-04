<?php   if(!defined('BASEPATH')) exit('Falha no carregamento do BASEPATH!');
  //Ativa o Buffer que armazena o conteúdo principal da página
  #seguranca_arq();

      foreach ($val as $array) {
           foreach ($array as $key => $value) {
                   if( $key == 'setores')   $setores = ($value);   
                   if( $key == 'menus_actions') $menus = ($value);
                   if( $key == 'usuarios')  $usuarios = ($value);   

                   
           }         
         } 
         
        $usuario = $_SESSION['session']['logado']['permissao']['action'];  
       $cadastrar= FALSE;
        $deletar = FALSE; $deletar_txt = ''; 
        $editar  = FALSE; $editar_txt  = '';
        $barra_txt = '';
        foreach ($usuario as $ls){
            if($ls['link']=='cadastrarusuario'){
                $cadastrar = TRUE;
            }
            if($ls['link']=='deletarusuario'){
                $deletar = TRUE;
               }
            if($ls['link']=='editarusuario'){
                $editar = TRUE;
            }   
        } 
        

        
if($cadastrar):
?>
<a href="#dialog_cadUsu" name="modal" ><img src="<?php echo BARRA.url_base.BARRA.BASEIMAGES?>add_user.png" />Adicionar novo</a>
<div id="dialog_cadUsu" class="window" >
    
    <a href="#" class="close">Fechar [X]</a><br />
    <div class="content_dialog">
<h3>Inserir usuário</h3>	
        <form id="" method="post" action="<?php echo BARRA.url_base?>/usuario/cadastrarusuario">
            <div class="pos_esq" >
		<p>
			<strong>Login</strong><br />
                        <input type="text" name="login" value="" />
		</p>
		<p>
			<strong>Nome</strong><br />
                        <input type="text" name="nome" value="" />
		</p>
		<p>
			<strong>Senha</strong><br />
                        <input type="password" name="senha" value="" />
		</p>
                <p>
                    <strong>Selecione o setor</strong><br />
                    <select name="setor">
				<option value="-1" selected>Selecione o setor</option>
				<?php
                                
                                
                                foreach ($setores as $ls){
                                        echo "<option value='{$ls['codigo']}'>".utf8_encode($ls['nome'])."</option>";
                                    }
                                    
                                ?>
			</select>
                </p>
            </div>
            <div class="pos_dir">
                <p>
                    Este usuário é administrador?
                    <input type="checkbox" name="adm" title="SIM" value="1">
		</p>
                <p>
                    <strong>Selecione as páginas que o usuário poderá ter acesso:</strong>
                </p>
                <div class="div_menus_actions">
                <?php
                
                    
                     
                    
                    foreach ($menus as $ls){
                       //identifica se é uma aba ou não
                       $aba_menu = $ls['action']=='1' ? ' [MENU/ABA] ' :'';
                       if(   $ls['link']=='logoff'||
                                  $ls['link']=='quemsomos'||
                                    $ls['link']=='minhaarea' ||
                                      $ls['link']=='faleconosco'||
                                          $ls['link']=='index'
                                        ){
                                    $disabled = "class='invisible'";
                          }
                          else $disabled = '';
                      if($ls['link'] == 'logoff' || $ls['link'] == 'minhaarea'){  
                       echo "<p {$disabled} >
                              <input type='checkbox' name='permissao[]' checked  value='{$ls['idmenu']}'>{$ls['nome']}{$aba_menu}<br>
                            </p>";
                          }
                     else{
                       echo "<p {$disabled} >
                             <input type='checkbox' name='permissao[]' value='{$ls['link']}'>{$ls['nome']}{$aba_menu}<br>
                            </p>";
                         }    
                     }
                     
                     
                ?>
                </div>    
		<p>
                    <input type="submit" onclick="return confirm('Deseja realmente inserir o usuário?');" style="float: right;" name="criarUsu" value="Inserir usuário" />
		</p>
            </div>   
	</form>
    </div>
</div> 
<?php
   endif;
?>
<div class="modulo">
<?php
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
	<h3>Listar usuários</h3>   
<table cellpadding="0" cellspacing="0" border="0" class="display" name="datatable">
   
	<thead>
		<tr>
			<th>Login</th>
			<th>Nome</th>
			<th>Setor</th>
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
              $rows ="";
              foreach ($usuarios as $ls){
                   $editar_usuario = $editar ? "<a href='".BARRA.url_base."/menu/editarusuario/id/{$ls['idusuario']}' onclick=\"return confirm('Deseja realmente editar o usuário {$ls['nome']}?');\" title='Editar' ><img alt='editar' src='".BARRA.url_base.BARRA.BASEIMAGES."editar.png' /></a>" : '' ;
                   $deletar_usuario  = $deletar  ? "<a href='".BARRA.url_base."/usuario/deletarusuario/id/{$ls['idusuario']}' onclick=\"return confirm('Deseja realmente excluir o usuário {$ls['nome']}?');\"  title='Excluir' ><img alt='excluir' src='".BARRA.url_base.BARRA.BASEIMAGES."excluir.png' /></a>" : '';
                  echo 
                      "<tr>"
                      ."<td>{$ls['login']}</td>"
                      ."<td>".utf8_encode($ls['nome'])."</td>"
                      ."<td>{$ls['setor']}</td>"
                      .$td_inicio
                      .$editar_usuario
                      .$deletar_usuario          
                      .$td_fim
                      ."</tr>"
                              
                  ;
              }
        ?>
         
      </tbody>
</table>
</div>
