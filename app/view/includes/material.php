<?php if(!defined('BASEPATH')) exit('Falha no carregamento do BASEPATH!');
   
    foreach ($val as $array) {
           foreach ($array as $key => $value) {
                   if( $key == 'materiais'   ){   $material = ($value);}
                   if( $key == 'grupos'      ){   $grupo = ($value);}
                   if( $key == 'detalheMaterial'   ){   $detalhe = ($value);}
                   if( $key == 'situacao'   ){   $situacao = ($value);}                  
                                     
           }         
         } 
         
        $usuario = $_SESSION['session']['logado']['permissao']['action'];  
    $detalheMat  = FALSE;    
     $usuario_on = $_SESSION['session']['logado']['usuario'][0];  
      $cadastrar = FALSE;
  $cadrequisicao = FALSE;
          $addOn = isset($_SESSION['addOn']) ? TRUE : FALSE;
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
            if($ls['link']=='detalhematerial'){
                $detalheMat = TRUE;
            }
        } 
           
         if(($editar || $deletar) && !($addOn) ){
                  $th_inicio = "<th>";
                  $th_fim    = "</th>";  
                  $td_inicio = "<td class='center'>";
                  $td_fim    = "</td>";
                  $editar_txt    = $editar  ? 'Editar' : ''; 
                  $barra_txt     = ($editar && $deletar)  ? '/' : ''; 
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
            <form  action="<?php echo BARRA.url_base?>/material/cadastrarmaterial" method="post">
                <div class="pos_center">
                    <p>
                            <strong>Grupo:</strong><br />
                            <select name="grupoMaterial" style="width: 260px;" >
				<option value="-1" selected>Selecione o material</option>
                            <?php
                            foreach ($grupo as $ls){
                                    echo "<option value='{$ls['idcategoria']}'>".utf8_encode($ls['nome'])."</option>";                                
                            }
                            ?>
                             </select>
                    </p>
                    <p>
                            <strong>Código do material:</strong><br />
                            <input type="number" name="codigoMaterial" style="width: 260px;" value="" required="required" />
                    </p>
                    <p>
                            <strong>Descrição:</strong><br />
                            <input type="text" name="detalheMaterial" style="width: 260px;" value="" required="required" />
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
    <a href='<?php echo BARRA.url_base.BARRA ?>requisicao/cadastrarrequisicao/?ativarReq=on' id="opcoes"  ><img src="<?php echo BARRA.url_base.BARRA.BASEIMAGES?>plus.png" />Realizar requisição</a>

<?php
    endif;
?>
    
    <br>
    <strong>*Obs.: Nem todos os produtos listados abaixo estão disponíveis.<br> clique em "Realizar requisição" para apresentar apenas os disponíveis!  </strong>
    
    
	<h3>Listar Material</h3>
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="material" name="">
	<thead>
		<tr>
			<th>Código</th>
			<th>Descrição</th>
                        <th>Categoria</th>
                        <?php 
                        if($detalheMat)  echo '<th>Detalhes</th>';

                        echo 
                            
                                 $th_inicio   
                                .$editar_txt
                                .$barra_txt
                                .$deletar_txt
                                .$th_fim;
                        
                         if($addOn)  echo '<th style="text-align: center;">Adicionar</th>';
                         ?>
                       
                </tr>
	</thead>
        <tbody>
        
        <?php 
        //var_dump($material);
            
        foreach ($material as $ls){
            $deletar_material = ($deletar) && !($addOn) ? "<a href='".BARRA.url_base."/setor/deletarmaterial/codigo/{$ls['idmaterial']}' onclick=\"return confirm('Deseja realmente excluir o setor ".utf8_encode($ls['nome'])."?');\"  title='Excluir' ><img alt='excluir' src='".BARRA.url_base.BARRA.BASEIMAGES."excluir.png' /></a>":''; 
            $editar_material  = ($editar) && !($addOn) ? "<a href='".BARRA.url_base."/material/editarmaterial/?codigoMaterial={$ls['idmaterial']}' onclick=\"return confirm('Deseja realmente editar o setor ".utf8_encode($ls['nome'])."?');\" title='Editar' ><img alt='editar' src='".BARRA.url_base.BARRA.BASEIMAGES."editar.png' /></a>":'';                     
            $linkAdd  = ($addOn)  ? "<td class='' style=\"text-align: center;\" ><a href='".BARRA.url_base."/requisicao/cadastrarrequisicao/?adicionar=on&&codigo={$ls['codigo']}&&categoria={$ls['categoria']}&&descricao=".utf8_encode($ls['nome'])."&&id={$ls['idmaterial']}'  title='adicionar' ><img alt='add' src='".BARRA.url_base.BARRA.BASEIMAGES."plus.png' /></a></td>":'';                     
            $quantidadeOn = ($detalheMat) ? "<td><a href='".BARRA.url_base."/material/detalhematerial/?codigoMaterial={$ls['idmaterial']}' ><img src='".BARRA.url_base.BARRA.BASEIMAGES."detalhe.png' alt='detalhes' title='detalhes' /></a></td>":'';
            //altera a cor da linha identificando que o produto está em falta ou proximo
                  #$sitmaterial = ($ls->getQuantidadeatual() > 0 )? "class='gradeA'" : "class='gradeX'";
                  echo 
                      "<tr>"
                      ."<td>{$ls['codigo']}</td>"
                      ."<td>".utf8_encode($ls['nome'])."</td>"
                      ."<td>{$ls['categoria']}</td>"
                      .$quantidadeOn   
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
   if($addOn):
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
                                    echo "<option value='{$ls['idcategoria']}'>".utf8_encode($ls['nome'])."</option>";                                
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
        <form action="<?php echo BARRA.url_base?>/requisicao/cadastrarrequisicao" method="POST">
            <h1>Requisição Almoxarifado</h1>    
            <strong>Código requisição:</strong><?php echo "<input type='text' style='display:none;' name='codigoreq' value='{$_SESSION['addOn']}' />{$_SESSION['addOn']}" ?><br>  
            <strong>Usuário requisitante:</strong><?php echo "<input type='text' style='display:none;' name='usuarioreq' value='{$usuario_on['idusuario']}' />{$usuario_on['nome']}" ?><br>
            <strong>Data da requisição:</strong><?php echo date('d/m/y') ?>
          <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Categoria</th>
                    <td>Descrição</td>
                    <th>Quantidade</th>
                    <th>Ação</th>
                </tr>
            </thead>
            
            <tbody> 
            
        <?php
        $requisicao = $_SESSION['cadReq'];
        
            foreach ($requisicao as $ls){
                echo "<tr>"
                     . "<td><input type='text' style='display:none;' name='idmaterial[]' value='{$ls[3]}' />{$ls[0]}</td>"
                     . "<td>{$ls[1]}</td>"
                     . "<td>{$ls[2]}</td>"
                     . "<td><input type='number' name='quantidade[]' value='1' /></td>"  
                     . "<td><a href='".BARRA.url_base."/requisicao/cadastrarrequisicao/?remover={$ls[0]}'>remover</a></td>"                      
                     . "</tr>";
            }
           
        ?>
            </tbody>
            
            
           </table>
           <input type="submit" name="cancelar" value="Cancelar requisição">
           <input type="submit" name="finalizar" value="Finalizar requisição"><br>&nbsp;
       </form> 
    </div>
    
<?php
 endif;
?>
</div>
<?php
   endif;

        if(isset($_SESSION['detalhe'])):
           
        
?>
<script type="text/javascript">
   $(function(){
       
       $('a[href=#detalhe]').click();
      
   });
</script>
<a href="#detalhe" name="modal" ></a>

<div id="detalhe" class="window" >
<?php 
   
    $material_detalhe = $_SESSION['detalhe'][0];
?>
    <a href="#" class="close">Fechar [X]</a><br>
    <div class="content_dialog">
     <div class="pos_center">  
         <p>
         <table> 
          <tr>  
              <td> <label><b>Código:</b></label></td>
              <td><?php echo $material_detalhe['codigo']?></td>
         </tr>  
         <tr>
             <td><label><b>Detalhe:</b></label></td>
             <td><?php echo utf8_encode($material_detalhe['nome'])?></td>
         </tr>
         <tr>
             <td><label><b>Data da última entrada:</b></label></td>
             <td><?php echo $material_detalhe['data_ultima_entrada']?></td>
         </tr>
         <tr>
             <td><label><b>Quantidade da última entrada:</b></b></label></td>
             <td><?php echo $material_detalhe['qtd_ultima_entrada']?></td>
         </tr>
         <tr>
             <td><label><b>Data da última saída:</b></label></td>
             <td><?php echo $material_detalhe['data_ultima_saida']?></td>
         </tr>
         <tr>
             <td><label><b>Quantidade da última saída:</b></label></td>
             <td><?php echo $material_detalhe['qtd_ultima_saida']?></td>
        </tr>
        <tr>
            <td><label><b>Quantidade atual:</b></label></td>
            <td><?php echo $material_detalhe['qtd_atual']?></td>
        </tr>
        <tr>
            <td><label><b>Categoria:</b></label></td>
            <td><?php echo $material_detalhe['categoria']?></td>
        </tr>
        <tr>
            <td><label><b>Situação:</b></label></td>
            <td><?php echo $material_detalhe['situacao']?></td>
         </tr> 
         </table>
         </p>
     </div> 

</div>
</div> 
<?php
        stopSession('detalhe');
        endif;

        if(isset($_SESSION['editar'])):
            
           $material_edicao = $_SESSION['editar'][0];
?>
<script type="text/javascript">
   $(function(){
       
       $('a[href=#editarMaterial]').click();
      
   });
</script>

<a href="#editarMaterial" name="modal" ></a>    
<div id="editarMaterial" class="window" >
    
    <a href="#" class="close">Fechar [X]</a><br>
    <div class="content_dialog">
            <form  action="<?php echo BARRA.url_base?>/material/editarrmaterial/id/<?php echo $material_edicao['idmaterial'] ?>" method="post">
                <div class="pos_center">
                    <table cellpadding="0" cellspacing="0" border="0" >
               
                  <tbody>   
                    <tr>
                        <td><input type="checkbox" id="grupoMaterial" title="editar" name="verifica" onclick="exibir(this)"></td>
                        <td><strong>Grupo:</strong></td>
                        <td >     
                            <select name="grupoMaterial" class="editar"  style="width: 260px;" >
				
                            <?php
                            foreach ($grupo as $ls){
                                
                                    $checked = ($ls['codigo']==$material_edicao['categoria']) ? 'checked': '';
                                    echo "<option $checked value='{$ls['idcategoria']}'>".utf8_encode($ls['nome'])."</option>";                                
                            }
                            ?>
                             </select>
                        </td>
                   </tr>
                   <tr>
                       <td>&nbsp;</td>
                       <td><strong>Código do material:</strong> </td>
                       <td><input type="number" name="codigoMaterial"  class="editar" style="width: 260px;" value="<?php echo $material_edicao['codigo'] ?>" required="required" /></td>
                           
                    </tr>
                    <tr>
                        <td><input type="checkbox" id="detalheMaterial" title="editar" name="verifica" onclick="exibir(this)"></td>
                        <td><strong>Descrição:</strong></td>
                        <td><input type="text" name="detalheMaterial" class="editar" style="width: 260px;" value="<?php echo utf8_encode($material_edicao['nome']) ?>" required="required" /></td>
                     </tr>
                     <tr>
                         <td><input type="checkbox" id="situacaoMaterial" title="editar" name="verifica"  onclick="exibir(this)"></td>
                         <td><strong>Situação:</strong></td>
                                 <td>
                                     <select name="situacaoMaterial"  class="editar" style="width: 260px;">
                                         <?php
                                          foreach ($situacao as $ls){
                                            $checked = ($ls['idsituacao'] === $material_edicao['situacao']) ? 'checked': '';
                                            echo "<option $checked value='{$ls['idsituacao']}'>".utf8_encode($ls['codigo'])."</option>";                  
                                            
                                          }    
                                         ?>
                                     </select>
                                 </td>
                     </tr>
                     <tr>

                         <td colspan="3" style="text-align: right;"><input type="submit" name="materialE" value="Editar material" /></td>
                         
                    </tr>
                  </tbody>
                </table>  
                </div>
            </form>
    </div>
</div>
<?php
        stopSession('editar');
    endif;
?>
    
    
<!--
	Fim de conteúdo
-->