<?php if(!defined('BASEPATH')) exit('Falha no carregamento do BASEPATH!');
   
      foreach ($val as $array) {
           foreach ($array as $key => $value) {
                   if( $key == 'requisicoes')   $requisicoes = ($value);   
           }         
         }
      
     $usuario = $_SESSION['session']['logado']['permissao']['action'];  
     $detalhe = FALSE;
     foreach ($usuario as $ls){
         if($ls['link']=='detalherequisicao'){
             $detalhe = TRUE;
         }
     }
         

?>
<!--
	Início de conteúdo
-->
<script>
$(function(){
       $('#requisicao').dataTable().columnFilter({aoColumns:[
				{ sSelector: "#coluna4", type:"select" }
				]}
			);
  ;
});

</script>
<!--<a href="#" id="opcoes">[+]Opções</a>-->
<div class="opcoes">
<table cellspacing="0" cellpadding="0" border="0" class="display" ID="Table1">
			
			<tbody>
				<tr id="filter_global">
                                    <td align="center">Seila</td>
					<td align="center" id="coluna1"></td>
				</tr>
				<tr id="filter_col1">
                                    <td align="center">Sl</td>
					<td align="center" id="coluna2"></td>
				</tr>
				<tr id="filter_col2">
                                    <td align="center">Sstor</td>
					<td align="center" id="coluna3"></td>
				</tr>
                                <tr id="filter_col3">
					<td align="center">Setor</td>
					<td align="center" id="coluna4"></td>
				</tr>
                                <tr id="filter_col4">   
                                    <td align="center">coluna5</td>
					<td align="center" id="coluna5"></td>
                                </tr>
			</tbody>
</table>
</div>
<div class="modulo">
<h3>Requisições</h3>
<table cellpadding="0" cellspacing="0" border="0" class="display" name="" id="requisicao"> 
	<thead>
		<tr>
			<th>Código da Requisição</th>
			<th>Data da Requisição</th>
                        <th>Situação</th>
                        <th>Setor</th>
                        <th>Ação</th>
		</tr>
	</thead>
        <tbody>
        
        <?php 
        foreach ($requisicoes as $ls){
            $detalhe_ =  "<a href='".BARRA.url_base."/requisicao/cadastrarrequisicao/?detalhar=on&&codigoReq={$ls['idrequisicao']}' ><img src='".BARRA.url_base.BARRA.BASEIMAGES."detalhe.png' alt='detalhes' title='Visualizar detalhes' /></a>";

            echo '<tr>';
            echo "<td>{$ls['codigo']}</td>";
            echo "<td>{$ls['momento']}</td>";
            echo "<td>{$ls['status']}</td>";
            echo "<td>{$ls['setor']}</td>";
            echo "<td>$detalhe_</td>";
            echo '</tr>';

        }
        ?>
         
      </tbody>
</table>

</div>
<?php 
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
   
    $requisicao_detalhe = $_SESSION['detalhe'][0];
?>
    <a href="#" class="close">Fechar [X]</a><br>
    <div class="content_dialog">
     <div class="pos_center">  
         <p>
         <table> 
          <tr>  
              <td> <label><b>Código:</b></label></td>
              <td><?php echo $requisicao_detalhe['codigo']?></td>
         </tr>  
         <tr>
             <td><label><b>Setor:</b></label></td>
             <td><?php // echo $requisicao_detalhe['setor']?></td>
         </tr>
         <tr>
             <td><label><b>Data:</b></b></label></td>
             <td><?php echo $requisicao_detalhe['momento']?></td>
         </tr>
         <tr>
             <td><label><b>Status:</b></label></td>
             <td><?php echo $requisicao_detalhe['status']?></td>
         </tr> 
         </table>
         </p>
     </div> 

</div>
</div>
<?php 
    endif;
?>
<!--
	Fim de conteúdo
-->