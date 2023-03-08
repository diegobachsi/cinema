<?php

	include('../config/conexao.php');

    $id_filme = $_GET['id_filme'];

	//criando a query
	$sql = "DELETE FROM filme WHERE id = '$id_filme'";

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