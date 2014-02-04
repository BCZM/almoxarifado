<?php if(!defined('BASEPATH')) exit('Falha no carregamento do BASEPATH!');
  //Ativa o Buffer que armazena o conteúdo principal da página
   seguranca_arq();
 
?>
<!--
	Início de conteúdo
-->
<h2>Requisição</h2>

<div id="botoes">
    <a href="<?php echo BARRA.url_base.BARRA?>menu/material"><img src="<?php echo BARRA.url_base.BARRA.BASEIMAGES?>setor.png" />Material</a>
    <a href="<?php echo BARRA.url_base.BARRA?>menu/requisicao"><img src="<?php echo BARRA.url_base.BARRA.BASEIMAGES?>user.png" />Requisição</a>
    
</div>
<?php  
    echo 'Selecione algum menu!';
?>
<!--
	Fim de conteúdo
-->
  