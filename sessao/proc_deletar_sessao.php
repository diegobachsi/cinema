<?php

	include('../config/conexao.php');

    $numero = $_GET['id_filme'];

	//criando a query
	$sql = "DELETE FROM sessao WHERE numero = '$numero'";

	//salva no banco de dados
	if (mysqli_query($conn, $sql)){
		//sucesso
		header('Location: http://localhost/cinema/index.php');
	} else {
			echo 'query_error: '.mysqli_error($conn);
	}

    //Fechar conexão
    mysqli_close($conn);
	
?>