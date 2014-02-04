<?php if(!defined('BASEPATH')) exit('Falha no carregamento do BASEPATH!');
   
    foreach ($val as $array) {
           foreach ($array as $key => $value) {
                   if( $key == 'materiais'   ){   $material = ($value);}
                   if( $key == 'grupos'      ){   $grupo = ($value); break;}
                                     
           }         
         } 
         
        $usuario = $_SESSION['session']['logado']['permissao']['action'];  
      $cadastrar = FALSE;
  $cadrequisicao = FALSE;
        $deletar = FALSE; $deletar_txt = ''; 
        $editar  = FALSE; $editar_txt  = '';
      $barra_txt = '';
        foreach ($usuario as $ls){
            if($ls['link']=='cadastrarmaterial'){
                $cadastrar = TRUE;
            }
            if($ls['link']=='deletarmaterial'){
                $deletar = TRUE;
               }
            if($ls['link']=='editarmaterial'){
                $editar = TRUE;
            }
            if($ls['link']=='cadastrarrequisicao'){
                $cadrequisicao = TRUE;
            }            
        } 
         
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
<!--
	Início de conteúdo
-->
<div class="modulo">
<?php
    if($cadastrar):
?>
    <a href="#dialog" name="modal" ><img src="<?php echo BARRA.url_base.BARRA.BASEIMAGES?>plus.png" />Adicionar novo</a>

<div id="dialog" class="window" >
    
    <a href="#" class="close">Fechar [X]</a>
    <div class="content_dialog">
            <form  action="<?php echo BARRA.url_base?>/setor/cadastrarmaterial" method="post">
                <div class="pos_center">
                    <p>
                            <strong>Grupo:</strong><br />
                            <select name="material" style="width: 260px;" >
				<option value="-1" selected>Selecione o material</option>
                            <?php
                            foreach ($grupo as $ls){
                                    echo "<option value='{$ls['codigo']}'>".utf8_encode($ls['nome'])."</option>";                                
                            }
                            ?>
                             </select>
                    </p>
                    <p>
                            <strong>Código do material:</strong><br />
                            <input type="number" name="codigoSetor" style="width: 260px;" value="" required="required" />
                    </p>
                    <p>
                            <strong>Descrição:</strong><br />
                            <input type="text" name="codigoSetor" style="width: 260px;" value="" required="required" />
                    </p>
                    <p>
                        <input type="submit" name="insertS" value="Cadastrar material" />
                    </p>
                </div>
            </form>
    </div>
</div>
<?php
    endif;
?>
<?php
    if($cadrequisicao):
?>
    <a href="#" id="opcoes"  ><img src="<?php echo BARRA.url_base.BARRA.BASEIMAGES?>plus.png" />Realizar requisição</a>

<?php
    endif;
?>
	<h3>Listar Material</h3>
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="material" name="">
	<thead>
		<tr>
			<th>Código</th>
			<th>Detalhes</th>
                        <th>Categoria</th>
                        <?php echo 
                            
                                 $th_inicio   
                                .$editar_txt
                                .$barra_txt
                                .$deletar_txt
                                .$th_fim
                            
                         ?>
                        <th></th>
		</tr>
	</thead>
        <tbody>
        
        <?php 
        //var_dump($material);
            
        foreach ($material as $ls){
            $deletar_material = ($deletar) ? "<a href='".BARRA.url_base."/setor/deletarmaterial/codigo/{$ls['idmaterial']}' onclick=\"return confirm('Deseja realmente excluir o setor ".utf8_encode($ls['nome'])."?');\"  title='Excluir' ><img alt='excluir' src='".BARRA.url_base.BARRA.BASEIMAGES."excluir.png' /></a>":''; 
            $editar_material  = ($editar)  ? "<a href='".BARRA.url_base."/menu/editarmaterial/id/{$ls['idmaterial']}' onclick=\"return confirm('Deseja realmente editar o setor ".utf8_encode($ls['nome'])."?');\" title='Editar' ><img alt='editar' src='".BARRA.url_base.BARRA.BASEIMAGES."editar.png' /></a>":'';                     
            $linkAdd  = ($cadrequisicao)  ? "<td class='' ><a href='".BARRA.url_base."/requisicao/adicionarmaterial/id/{$ls['idmaterial']}/cat/{$ls['categoria_codigo']}'  title='adicionar' ><img alt='add' src='".BARRA.url_base.BARRA.BASEIMAGES."plus.png' /></a></td>":'';                     
            
            //altera a cor da linha identificando que o produto está em falta ou proximo
                  #$sitmaterial = ($ls->getQuantidadeatual() > 0 )? "class='gradeA'" : "class='gradeX'";
                  echo 
                      "<tr>"
                      ."<td>{$ls['idmaterial']}</td>"
                      ."<td>".utf8_encode($ls['nome'])."</td>"
                      ."<td>{$ls['categoria_codigo']}</td>"
                      .$td_inicio
                      .$editar_material
                      .$deletar_material
                      .$td_fim
                      .$linkAdd     
                      ."</tr>"
                              
                 ;
         }
        ?>
         
      </tbody>
</table>
</div>
<?php
    if($cadrequisicao):
?>
<div class="modulo">
    <div id="" class="opcoes" >
    
            <form  action="<?php echo BARRA.url_base?>/requisicao/cadastrarrequisicao" method="post">
                    <p>
                            <strong>Grupo:</strong><br />
                            <select name="material" style="width: 260px;" >
				<option value="-1" selected>Selecione o material</option>
                            <?php
                            foreach ($grupo as $ls){
                                    echo "<option value='{$ls['codigo']}'>".utf8_encode($ls['nome'])."</option>";                                
                            }
                            ?>
                             </select>
                    </p>
                    <p>
                            <strong>Código do material:</strong><br />
                            <input type="number" name="codigoSetor" style="width: 260px;" value="" required="required" />
                    </p>
                    <p>
                            <strong>Descrição:</strong><br />
                            <input type="text" name="codigoSetor" style="width: 260px;" value="" required="required" />
                    </p>
                    <p>
                        <input type="submit" name="insertS" value="Cadastrar material" />
                    </p>
            </form>
    </div>
   
<?php 
    if(isset($_SESSION['cadReq'])):
       
?>    
    <div class="material">
        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Categoria</th>
                    <th>Quantidade</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
        <?php
        $requisicao = $_SESSION['cadReq'];
        
            foreach ($requisicao as $ls){
                echo "<tr>"
                     . "<td>{$ls[0]}</td>"
                     . "<td>{$ls[1]}</td>"
                     . "<td><input type='number' name='quantidade' value='1' /></td>"  
                     . "<td><a href='".BARRA.url_base."/requisicao/removermaterial/id/{$ls[0]}'>remover</a></td>"                      
                     . "</tr>";
            }
           
        ?>
            </tbody>
        </table>  
    </div>
    
<?php
    endif;
?>
</div>
<?php
    endif;
?>

<!--
	Fim de conteúdo
-->