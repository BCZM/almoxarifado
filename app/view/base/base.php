<?php if(!defined('BASEPATH')) exit('Falha no carregamento do script!'); 
       foreach ($val as $array) {
           foreach ($array as $key => $value) {
                   if( $key == 'titulo'   )   $titulo = ($value);   
                   if( $key == 'control'  )  $control = ($value);      
           }         
         
        } 
       if(isset($titulo) && $titulo !=NULL);
       else $titulo = 'sem titulo';
       
?>

<!DOCTYPE HTML>
<html>

<head>
    <title>
     <?php 
     echo $titulo;
     ?>
    </title>
	<meta name="description" content="AlmoXerife - Sistema de almoxarifado da Biblioteca Central Zila Mamede" />
	<meta name="keywords" content="almoXerife, almoxarifado, biblioteca central zila mamede, bczm" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"  />
	<meta http-equiv="content-language" content="pt-br">
	<meta name="author" content="Sessão de Suporte Técnico da Biblioteca Central Zila Mamede, Ítalo Patrício, Marcel de Freitas">
	<meta name="reply-to" content="sst@bczm.ufrn.br">
	<meta name="robots" content="index,follow"><!--indexar página e seus links-->
	<meta name="robots" content="archive"><!--arquivar no cache dos buscadores-->
  
  
 
  <?php 
  allLoadCss(BASECSS);
  allLoadJs(BASEJS);
  
  ?>


</head>

<body>
   
	<div id="main">
		<div id="header">
			<div id="logo">
				<a href="http://www.bczm.ufrn.br" target="blank">
                                  <img src="<?php echo BARRA.url_base.BARRA.BASEIMAGES ?>logo-sisbi.png" alt="Logomarca do SISBI" />
                                </a>
				<div class="unidade">Biblioteca Central Zila Mamede</div>
				<div id="almoxerife">
					<h1>Almo<a href="index">Xerife</a></h1>
					<span>Sistema de almoxarifado</span>
				</div>
			</div>
			<div id="menubar">
				<ul id="menu">
                <!--  -->
                <?php
                    if (isset($val)) {
                        #print_r($val);
                        #var_dump($val);
                        foreach ($val as $row){
                      if(isset($row[0]['nome'])){
                              echo '<li class="current"><a href="'.BARRA.url_base.BARRA.$control.$row[0]['link'].'">'.utf8_encode($row[0]['nome']).'</a></li>';
                       
                          }
                        }   
                     }
                   else {
                         echo 'Falha no carregamento do menu!';
                   }
                ?>


                                </ul>
			</div>
		</div>
		<div id="site_content">
			<div id="content">
                                <?php
             if(isset($_SESSION['msg'])){
                // <!-- Área para mensagem retornada de erro ou aviso  -->

                 echo $_SESSION['msg'];
                 #var_dump($_SESSION);
                 stopSession('msg');
             }
                                    
                                
                                
				#<!-- inserir conteudo da pagina aqui -->
                                  if(isset($content_page)) echo $content_page; 
						else echo 'NENHUMA PÁGINA FOI CARREGADA!'; 
				?>
			</div><!-- Fim div content-->
		</div><!-- Fim div site_content-->
		<div id="footer">
			<p>Todos os direitos reservados à  <a href="http://www.bczm.ufrn.br/" target="blank">Biblioteca Central Zila Mamede</a></p>
			<p>Desenvolvido pela <a href="mailto:sst@bczm.ufrn.br" target="blank">Sessão de Suporte Técnico</a></p>
		</div>
	</div>
    <div id="top"><img src="<?php echo BARRA.url_base.BARRA.BASEIMAGES ?>subir.png" alt="Subir ao topo da página"  title="Ir ao topo"/></div>

        <!-- Máscara para cobrir a tela -->
        <div id="mask"></div>
</body>
</html>

