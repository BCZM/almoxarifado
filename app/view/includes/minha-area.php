<?php if(!defined('BASEPATH')) exit('Falha no carregamento do BASEPATH!');
#seguranca_arq();
?>
<!--
	Início de conteúdo
-->
<h2>Minha área</h2>

<div class="modulo">
	<h3>Meus dados</h3>
        <?php  
                $usu = $_SESSION['session']['logado']['usuario'];
                $usu = ($usu);
                
            ?>
	<p>
            <strong>Login:</strong> <?php echo  $usu[0]['login'] ?>  
	</p>
	<p>
            <strong>Nome:</strong>  <?php echo  $usu[0]['nome'] ?> 
	</p>
        
	<p>
            <strong>Setor:</strong> <?php echo  $usu[0]['setor'] ?>
	</p>
</div>
		
<div class="modulo">
	<h3>Minhas últimas requisições</h3>	
</div>

<div class="modulo">
	<h3>Alterar meus dados</h3>
        <form id="" action="<?php echo BARRA.url_base?>/login/minhaarea/?acao=alterarlogin" method="post">
		<p>
			<strong>Login</strong><br />
                        <input type="text" name="newlogin" value="" required="required" />
		</p>
                <p>
			<strong>Senha atual</strong><br />
                        <input type="password" name="senhaAt"  required="required" />
		</p>
		<p>
                    <input type="submit" name="alterarD" value="Alterar dados" />
		</p>
		<p>
			*O setor pode ser alterado somente pelo administrador deste sistema. Se necessário, solicite através do menu Fale Conosco.
		</p>
	</form>
</div>

<div class="modulo">
	<h3>Alterar minha senha</h3>	
        <form id="alterarSenha" action="<?php echo BARRA.url_base?>/login/minhaarea/?acao=alterarsenha" method="post">
		<p>
			<strong>Senha atual</strong><br />
                        <input type="password" name="senhaAt" required="required" />
		</p>
		<p>
			<strong>Nova senha</strong><br />
                        <input type="password" id="senha" name="senha"  />
		</p>
		<p>
			<strong>Confirmação da nova senha</strong><br />
                        <input type="password" id="newsenha" name="newsenha" />
		</p>
		<p>
                    <input type="submit" name="alterarSenha" value="Alterar senha" />
		</p>
	</form>
</div>

<!--
	Fim de conteúdo
-->