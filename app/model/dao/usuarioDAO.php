<?php if(!defined('BASEPATH')) exit('Falha no carregamento do script!');


require_once (BASEMODELCLASS.'usuarioClass.php');


class usuarioDAO{

    /*
    * Altera
    * Recebe array como parametro
    */
    public function Update($dados){

        $retorno = 0;

        # Faz conex�o
        $conexao = new conexaoBanco();
        $conexao->conectar();

        # Executa comando SQL
        $stmt = $conexao->pdo->prepare('UPDATE usuario SET login = ?, nome = ?, matricula = ?, senha = ?, setor_idsetor = ?, tipousuario_idtipousuario = ?, idusuario = ?  WHERE idusuario = ?');

        # Seta Atributos nulos


        # Parametros
        $stmt->bindValue(1,$dados->getLogin());
        $stmt->bindValue(2,$dados->getNome());
        $stmt->bindValue(3,$dados->getMatricula());
        $stmt->bindValue(4,$dados->getSenha());
        $stmt->bindValue(5,$dados->getSetor_idsetor());
        $stmt->bindValue(6,$dados->getTipousuario_idtipousuario());
        $stmt->bindValue(7,$dados->getIdusuario());


        try{
            $retorno = $stmt->execute();
        }
        catch (PDOException $e) {
            echo 'Erro: '.$e->getMessage();
            $retorno = -1;
        }

        return $retorno;
    }
    /*
    * M�todo de Inclus�o
    * Insere dados recebendo valores via par�metro
    * ---------------------------------------------
    */
    public function incluir($dados){
        # Faz conex�o
        $conexao = new conexaoBanco();
        $conexao->conectar();

        try{
            $stmt = $conexao->pdo->prepare('INSERT INTO usuario (login, nome, matricula, senha, setor_idsetor, tipousuario_idtipousuario, idusuario) VALUES (?,?,?,?,?,?,?)');



			$stmt->bindValue(1,$dados->getLogin());
			$stmt->bindValue(2,$dados->getNome());
			$stmt->bindValue(3,$dados->getMatricula());
			$stmt->bindValue(4,$dados->getSenha());
			$stmt->bindValue(5,$dados->getSetor_idsetor());
			$stmt->bindValue(6,$dados->getTipousuario_idtipousuario());
			$stmt->bindValue(7,$dados->getIdusuario());

            $retorno = $stmt->execute();
        }
        catch ( PDOException $ex ){  
            echo 'Erro: ' . $ex->getMessage(); 
        }

        return $retorno;
    }
    /*
     * Verifica usuario
     * 
     */
    public function VerificaUsu($login,$senha){
    
    	# Faz conex�o
	    $conexao = new conexaoBanco();
	    $conexao->conectar();

	    # Executa comando SQL
	    $stmt = $conexao->pdo->prepare('SELECT login, nome, matricula, (SELECT nome FROM setor WHERE idsetor = setor_idsetor) as setor, tipousuario_idtipousuario, idusuario FROM usuario WHERE login = ? AND senha = ? ');

	    # Passando os valores a serem usados
    	$dados = array($login,$senha);
    	$stmt->execute($dados);
    	$retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);

       if($retorno!=null){ 
           
    	#Inst�ncia da entidade
    	$usuarioClass = new usuarioClass();

    	foreach( $retorno as $row ){

    		#Atribui valores
		    $usuarioClass->setLogin($row['login']);
		    $usuarioClass->setNome($row['nome']);
		    $usuarioClass->setMatricula($row['matricula']);
		    $usuarioClass->setSetor_idsetor($row['setor']);
		    $usuarioClass->setTipousuario_idtipousuario($row['tipousuario_idtipousuario']);
		    $usuarioClass->setIdusuario($row['idusuario']);
    	}
                    
                    //$_SESSION['usuario'] = $retorno['idusuario'];//armazeno os dados do usuario na sessão usuario
                    
            return $usuarioClass;
       }
       else{ 
            
         //$_SESSION['logado'] = false;  
        return FALSE;
       
       }
    }

    /*
    * Obtem por Pk
    */
    public function ObterPorPK($pk){

    	# Faz conex�o
	    $conexao = new conexaoBanco();
	    $conexao->conectar();

	    # Executa comando SQL
	    $stmt = $conexao->pdo->prepare('SELECT login, nome, matricula, senha, setor_idsetor, tipousuario_idtipousuario, idusuario FROM usuario WHERE idusuario = ? ');

	    # Passando os valores a serem usados
    	$dados = array($pk);
    	$stmt->execute($dados);
    	$retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);

    	#Inst�ncia da entidade
    	$usuarioClass = new usuarioClass();

    	foreach( $retorno as $row ){

    		#Atribui valores
		    $usuarioClass->setLogin($row['login']);
		    $usuarioClass->setNome($row['nome']);
		    $usuarioClass->setMatricula($row['matricula']);
		    $usuarioClass->setSenha($row['senha']);
		    $usuarioClass->setSetor_idsetor($row['setor_idsetor']);
		    $usuarioClass->setTipousuario_idtipousuario($row['tipousuario_idtipousuario']);
		    $usuarioClass->setIdusuario($row['idusuario']);
    	}

    	return $usuarioClass;
    }
    /*
    * Obtem todos
    */
    public function ObterPorTodos(){

    	# Faz conex�o
    	$conexao = new conexaoBanco();
    	$conexao->conectar();

    	# Executa comando SQL
    	$stmt = $conexao->pdo->prepare('SELECT login, nome, matricula, senha, setor_idsetor, tipousuario_idtipousuario, idusuario FROM usuario ORDER BY idusuario DESC');

    	// Executa Query
    	$stmt->execute();
    	$retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);

    	$lista = array();
    	$i = 0;

    	foreach( $retorno as $row ){
    		#Inst�ncia da entidade
    		$usuarioClass = new usuarioClass();

    		#Atribui valores
		    $usuarioClass->setLogin($row['login']);
		    $usuarioClass->setNome($row['nome']);
		    $usuarioClass->setMatricula($row['matricula']);
		    $usuarioClass->setSenha($row['senha']);
		    $usuarioClass->setSetor_idsetor($row['setor_idsetor']);
		    $usuarioClass->setTipousuario_idtipousuario($row['tipousuario_idtipousuario']);
		    $usuarioClass->setIdusuario($row['idusuario']);

    		$lista[$i] = $usuarioClass;
    		$i++;
    	}

    	return $lista;
    }
    /*
    * Delete
    * Recebe PK como parametro
	*/
    public function Deletar($pk){

		$retorno = 0;

		# Faz conex�o
		$conexao = new conexaoBanco();
		$conexao->conectar();

		# Executa SQL
		$stmt = $conexao->pdo->prepare('DELETE FROM usuario WHERE idusuario = ?');

		$dadosDelete = array($pk);

		try{
			$retorno = $stmt->execute($dadosDelete);
		}
		catch (PDOException $e) {
			echo 'Erro: '.$e->getMessage();
			$retorno = -1;
		}

		return $retorno;
	}

}
?>
