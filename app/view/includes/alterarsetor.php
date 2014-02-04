<?php if(!defined('BASEPATH')) exit('Falha no carregamento do BASEPATH!');
#seguranca_arq();  
?>
<!--
        Início de Conteúdo
-->
<?php 
         foreach ($val as $array) {
           foreach ($array as $key => $value) {
                   if( $key == 'setor'   ){   $setor = ($value);   
                   break;
                   }
           }         
         }     
?>

<div class="modulo">
<h3>Editar setor</h3>	
	
		<p>
			<strong>Dados do setor</strong><br />
		</p>
<p>
    <strong>Nome atual:</strong><?php echo   utf8_encode($setor[0]['nome']) ?>
</p>
<p>
    <strong>Código atual:</strong><?php echo $setor[0]['codigo'] ?>
</p>
<form method="POST" action="<?php echo BARRA.url_base?>/setor/alterarnomesetor/codigo/<?php echo $setor[0]['codigo']?>">
    <p> 
        <strong>Novo nome:</strong><br>
        <input type="text" name="newname" required="required">
    </p>
    <p>
        <input type="submit" onclick="return confirm('Deseja realmente alterar o nome do setor?');" name="alterarN" value="Alterar nome">
    </p>
</form>
<form method="POST" action="<?php echo BARRA.url_base?>/setor/alterarcodigosetor/codigo/<?php echo $setor[0]['codigo']?>">
    <p>
        <strong>Novo código:</strong><br>
        <input type="text" name="newcodigo" required="required">
    </p>
    <p>
        <input type="submit" onclick="return confirm('Deseja realmente alterar o código do setor?');" name="alterarC" value="Alterar código">
    </p>
</form>
</div>
<!--
        Fim de Conteúdo
-->
