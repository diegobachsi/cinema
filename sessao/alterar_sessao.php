<?php

	include('../config/conexao.php');

    $erros = array('id_filme'=>'','num_sala'=>'','horario'=>'', 'dt_sessao'=>'', 'qtdAssentosDisponiveis'=>'', 'valorIngresso'=>'');

    $id_sessao = $_GET['id_sessao'];

    //Query para buscar
    $sql = "SELECT numero, id_filme, num_sala, horario, dt_sessao, qtdAssentosDisponiveis, valorIngresso FROM sessao WHERE numero = '$id_sessao' ";

    //Armazena os resultados da buscar
    $resultado_sessao = mysqli_query($conn,$sql);
    
    //Pega os resultados e coloca em um vetor
    $row_sessao = mysqli_fetch_assoc($resultado_sessao);

	$numero = $row_sessao['numero'];
    $id_filme = $row_sessao['id_filme'];
    $num_sala = $row_sessao['num_sala'];
    $horario = $row_sessao['horario'];
    $dt_sessao = $row_sessao['dt_sessao'];
    $qtdAssentosDisponiveis = $row_sessao['qtdAssentosDisponiveis'];
	$valorIngresso = $row_sessao['valorIngresso'];

    //Limpa o resultado da buscar
    mysqli_free_result($resultado_sessao);
    
    //Fechar conexão
    mysqli_close($conn);

	if (isset($_POST['enviar'])){

        include('../config/conexao.php');

        //Verificar id_filme
		if (empty($_POST['id_filme'])){
			$erros['id_filme'] = 'O id do Filme é obrigatório';
		} else{
			$id_filme = $_POST['id_filme'];	
		}
		
        //Verifica num_sala
		if (empty($_POST['num_sala'])){
			$erros['num_sala'] = 'Informe a sala da Sessão <br/>';
		} else{
			$num_sala = $_POST['num_sala'];
		}

		//Verifica horario
		if (empty($_POST['horario'])){
			$erros['horario'] = 'Horário é obrigatório <br/>';
		} else{
			$horario = $_POST['horario'];
		}

		//Verifica dt_sessao
		if (empty($_POST['dt_sessao'])){
			$erros['dt_sessao'] = 'Informe a data da Sessão <br/>';
		} else{
			$dt_sessao = $_POST['dt_sessao'];	
		}

		//Verifica qtdIngressosDisponiveis
		if (empty($_POST['qtdAssentosDisponiveis'])){
			$erros['qtdAssentosDisponiveis'] = 'Informe Qtd. de Assentos Disponiveis <br/>';
		} else{
			$qtdAssentosDisponiveis = $_POST['qtdAssentosDisponiveis'];	
		}

		//Verifica valorIngresso
		if (empty($_POST['valorIngresso'])){
			$erros['valorIngresso'] = 'Informe Valor do Ingresso <br/>';
		} else{
			$valorIngresso = $_POST['valorIngresso'];	
		}
		
		if (array_filter($erros)){
			//echo 'Erro no formulário <br/>';
		}else {
			//limpando códigos suspeitos
			$numero = mysqli_real_escape_string($conn, $_POST['numero']);
			$id_filme = mysqli_real_escape_string($conn, $_POST['id_filme']);
			$num_sala = mysqli_real_escape_string($conn, $_POST['num_sala']);
			$horario = mysqli_real_escape_string($conn, $_POST['horario']);
			$dt_sessao = mysqli_real_escape_string($conn, $_POST['dt_sessao']);
			$qtdAssentosDisponiveis = mysqli_real_escape_string($conn, $_POST['qtdAssentosDisponiveis']);
			$valorIngresso = mysqli_real_escape_string($conn, $_POST['valorIngresso']);

			//criando a query
			$sql = "UPDATE sessao SET id_filme = '$id_filme', num_sala = '$num_sala', horario = '$horario', dt_sessao = '$dt_sessao', qtdAssentosDisponiveis = '$qtdAssentosDisponiveis', valorIngresso = '$valorIngresso' WHERE numero = '$numero'";

			//salva no banco de dados
			if (mysqli_query($conn, $sql)){
				//sucesso
				header('Location: http://localhost/cinema/index.php');
			} else {
				echo 'query_error: '.mysqli_error($conn);
			}

            //Fechar conexão
            mysqli_close($conn);
        }
		
	}
?>


<!DOCTYPE html>
<html>
	<?php include('../templates/header.php')?>
	
	<section class="container grey-text padding">
		<div class="card-panel">
			<h4 class="center">Alterar Sessão</h4>
		</div>
		<form action="alterar_sessao.php" method="POST" >
			<br><br>
            <input type="hidden" name="numero" value="<?php echo $id_sessao?>">    
			
			<input placeholder="ID Filme" type="text" name="id_filme" value="<?php echo $id_filme?>">
			<div class="red-text"><?php echo $erros['id_filme'].'<br/>'?></div>

			<input placeholder="Numéro Sala" type="text" name="num_sala" value="<?php echo $num_sala?>">
			<div class="red-text"><?php echo $erros['num_sala'].'<br/>'?></div>

			<input placeholder="Horário da Sessão" type="text" name="horario" value="<?php echo $horario?>">
			<div class="red-text"><?php echo $erros['horario'].'<br/>'?></div>

			<input placeholder="Data da Sessão" type="text" name="dt_sessao" value="<?php echo $dt_sessao?>">
			<div class="red-text"><?php echo $erros['dt_sessao'].'<br/>'?></div>

			<input placeholder="Qtd. Assentos Disponiveis" type="text" name="qtdAssentosDisponiveis" value="<?php echo $qtdAssentosDisponiveis?>">
			<div class="red-text"><?php echo $erros['qtdAssentosDisponiveis'].'<br/>'?></div>

			<input placeholder="Valor do Ingresso" type="text" name="valorIngresso" value="<?php echo $valorIngresso?>">
			<div class="red-text"><?php echo $erros['valorIngresso'].'<br/>'?></div>



			<div class="center" style="margin-top: 10px;">
				<input type="submit" name="enviar" value="Enviar" class="btn brand z-depth-0">
			</div>
		</form>
	</section>
	<?php include('../templates/footer.php')?>
</html>