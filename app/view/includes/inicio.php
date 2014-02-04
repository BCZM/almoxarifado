<?php if(!defined('BASEPATH')) exit('Falha no carregamento do script!');

?>
<!--
	Início de conteúdo
-->
<form class="login" action='<?php echo BARRA.url_base?>/login/validar' method="post">
	<label for="username">Usuário</label>
	<input type="text" id="username" name="login">
	<br>
    <label for="password">Senha</label>&nbsp;&nbsp;&nbsp;
	<input type="password" id="password" name="senha">
	<br>
	<input type="submit" name="validar" value="Entrar" />
	<br>
	<p><a href="">Esqueci minha senha</a>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="">Cadastrar um novo usuário</a></p>
</form>
<!--
	Fim de conteúdo
-->
