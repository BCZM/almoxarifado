<?php if(!defined('BASEPATH')) exit(header('Location: ./../../../index.php'));

require_once (BASEMODEL.'conexaoBD.php');
require_once (BASEMODELCLASS.'materialClass.php');

class materialDAO{

    
    public function AlterarNome($nome,$idmaterial){

        $retorno = 0;

        # Faz conex�o
        $conexao = new conexaoBanco();
        $conexao->conectar();
        
        
        # Executa comando SQL
        $stmt = $conexao->pdo->prepare('UPDATE material SET nome = ?  WHERE idmaterial = ?');


        # Parametros
        $stmt->bindValue(2,$idmaterial);
        $stmt->bindValue(1,$nome);

        try{
            $retorno = $stmt->execute();
        }
        catch (PDOException $e) {
            echo 'Erro: '.$e->getMessage();
            $retorno = -1;
        }

        return $retorno;
    }
     public function AlterarQuantidade($quantidade,$idmaterial){

        $retorno = 0;

        # Faz conex�o
        $conexao = new conexaoBanco();
        $conexao->conectar();
        
        
        # Executa comando SQL
        $stmt = $conexao->pdo->prepare('UPDATE material SET quantidadeatual = ?  WHERE idmaterial = ?');


        # Parametros
        $stmt->bindValue(2,$idmaterial);
        $stmt->bindValue(1,$quantidade);

        try{
            $retorno = $stmt->execute();
        }
        catch (PDOException $e) {
            echo 'Erro: '.$e->getMessage();
            $retorno = -1;
        }

        return $retorno;
    }
    
    public function AlterarGrupo($grupo,$idmaterial){

        $retorno = 0;

        # Faz conex�o
        $conexao = new conexaoBanco();
        $conexao->conectar();
        
        
        # Executa comando SQL
        $stmt = $conexao->pdo->prepare('UPDATE material SET categoria_idcategoria = ?  WHERE idmaterial = ?');


        # Parametros
        $stmt->bindValue(2,$idmaterial);
        $stmt->bindValue(1,$grupo);

        try{
            $retorno = $stmt->execute();
        }
        catch (PDOException $e) {
            echo 'Erro: '.$e->getMessage();
            $retorno = -1;
        }

        return $retorno;
    }
    
    public function AlterarDetalhe($detalhe,$idmaterial){

        $retorno = 0;

        # Faz conex�o
        $conexao = new conexaoBanco();
        $conexao->conectar();
        
        
        # Executa comando SQL
        $stmt = $conexao->pdo->prepare('UPDATE material SET detalhes = ?  WHERE idmaterial = ?');


        # Parametros
        $stmt->bindValue(2,$idmaterial);
        $stmt->bindValue(1,$detalhe);

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
    * Altera
    * Recebe array como parametro
    */
    public function Update($dados){

        $retorno = 0;

        # Faz conex�o
        $conexao = new conexaoBanco();
        $conexao->conectar();

        # Executa comando SQL
        $stmt = $conexao->pdo->prepare('UPDATE material SET nome = ?, detalhes = ?, quantidadeatual = ?, categoria_idcategoria = ?  WHERE idmaterial = ?');

        # Seta Atributos nulos
		if(is_null($dados->getDetalhes())){
			$dados->setDetalhes(NULL);
		}


        # Parametros
        $stmt->bindValue(5,$dados->getIdmaterial());
        $stmt->bindValue(1,$dados->getNome());
        $stmt->bindValue(2,$dados->getDetalhes());
        $stmt->bindValue(3,$dados->getQuantidadeatual());
        $stmt->bindValue(4,$dados->getCategoria_idcategoria());


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
        $retorno = 0;
        try{
            $stmt = $conexao->pdo->prepare('INSERT INTO material (nome, detalhes, quantidadeatual, categoria_idcategoria) VALUES (?,?,?,?)');

		    if(is_null($dados->getDetalhes())){
			    $dados->setDetalhes(NULL);
		    }


			$stmt->bindValue(1,$dados->getNome());
			$stmt->bindValue(2,$dados->getDetalhes());
			$stmt->bindValue(3,$dados->getQuantidadeatual());
			$stmt->bindValue(4,$dados->getCategoria_idcategoria());

            $retorno = $stmt->execute();
        }
        catch ( PDOException $ex ){  
            //echo 'Erro: ' . $ex->getMessage(); 
            $retorno = -1;
        }

        return $retorno;
    }
    /*
    * Obtem por Pk
    */
    public function ObterPorNome($nome){

    	# Faz conex�o
	    $conexao = new conexaoBanco();
	    $conexao->conectar();

	    # Executa comando SQL
	    $stmt = $conexao->pdo->prepare('SELECT idmaterial, nome, detalhes, quantidadeatual, (SELECT nome FROM categoria WHERE idcategoria = categoria_idcategoria) as grupo FROM material WHERE nome = ? OR idmaterial = ? ');

	    # Passando os valores a serem usados
    $dados = array($nome,$nome);
    	$stmt->execute($dados);
    	$retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if($retorno != null){
    	#Inst�ncia da entidade
    	$materialClass = new materialClass();

    	foreach( $retorno as $row ){

    		#Atribui valores
		    $materialClass->setIdmaterial($row['idmaterial']);
		    $materialClass->setNome($row['nome']);
		    $materialClass->setDetalhes($row['detalhes']);
		    $materialClass->setQuantidadeatual($row['quantidadeatual']);
		    $materialClass->setCategoria_idcategoria($row['grupo']);
    	}

    	return $materialClass;
        }
        else{
            return FALSE;
        }
    }
    public function ObterPorPK($nome,$grupoCat){

    	# Faz conex�o
	    $conexao = new conexaoBanco();
	    $conexao->conectar();

	    # Executa comando SQL
	    $stmt = $conexao->pdo->prepare('SELECT  * FROM material WHERE idmaterial = \'?\' OR nome = \'?\'  AND categoria_idcategoria = \'?\' ');

	    # Passando os valores a serem usados
    	$dados = array($nome,$nome,$grupoCat);
    	$stmt->execute($dados);
    	$retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if($retorno != null){
    	#Inst�ncia da entidade
    	$materialClass = new materialClass();

    	foreach( $retorno as $row ){

    		#Atribui valores
		    $materialClass->setIdmaterial($row['idmaterial']);
		    $materialClass->setNome($row['nome']);
		    $materialClass->setDetalhes($row['detalhes']);
		    $materialClass->setQuantidadeatual($row['quantidadeatual']);
		    $materialClass->setCategoria_idcategoria($row['categoria_idcategoria']);
    	}

    	return $materialClass;
        }
        else{
            return FALSE;
        }
    }
     public function ObterDadosMaterialPorNome($nome){

    	# Faz conex�o
	    $conexao = new conexaoBanco();
	    $conexao->conectar();

	    # Executa comando SQL
	    $stmt = $conexao->pdo->prepare('SELECT idmaterial, nome, detalhes, quantidadeatual, categoria_idcategoria FROM material WHERE nome = ? ' );

	    # Passando os valores a serem usados
    	$dados = array($nome);
    	$stmt->execute($dados);
    	$retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if($retorno != null){
    	#Inst�ncia da entidade
    	$materialClass = new materialClass();

    	foreach( $retorno as $row ){

    		#Atribui valores
		    $materialClass->setIdmaterial($row['idmaterial']);
		    $materialClass->setNome($row['nome']);
		    $materialClass->setDetalhes($row['detalhes']);
		    $materialClass->setQuantidadeatual($row['quantidadeatual']);
		    $materialClass->setCategoria_idcategoria($row['categoria_idcategoria']);
    	}

    	return $materialClass;
        }
        else{
            return FALSE;
        }
    }
    /*
    * Obtem todos
    */
    public function ObterPorTodos(){

    	# Faz conex�o
    	$conexao = new conexaoBanco();
    	$conexao->conectar();

    	# Executa comando SQL
    	$stmt = $conexao->pdo->prepare('SELECT idmaterial, nome, detalhes, quantidadeatual, (SELECT nome FROM categoria WHERE idcategoria = categoria_idcategoria) as grupo   FROM material ORDER BY idmaterial DESC');

    	// Executa Query
    	$stmt->execute();
    	$retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);

    	$lista = array();
    	$i = 0;

    	foreach( $retorno as $row ){
    		#Inst�ncia da entidade
    		$materialClass = new materialClass();

    		#Atribui valores
		    $materialClass->setIdmaterial($row['idmaterial']);
		    $materialClass->setNome($row['nome']);
		    $materialClass->setDetalhes($row['detalhes']);
		    $materialClass->setQuantidadeatual($row['quantidadeatual']);
		    $materialClass->setCategoria_idcategoria($row['grupo']);

    		$lista[$i] = $materialClass;
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
		$stmt = $conexao->pdo->prepare('DELETE FROM material WHERE idmaterial = ?');

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
