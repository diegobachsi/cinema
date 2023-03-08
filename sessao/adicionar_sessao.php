<?php

	include('../config/conexao.php');

	$erros = array('id_filme'=>'','num_sala'=>'','horario'=>'', 'dt_sessao'=>'', 'qtdAssentosDisponiveis'=>'', 'valorIngresso'=>'');
	$id_filme = $num_sala = $horario = $dt_sessao = $qtdAssentosDisponiveis = $valorIngresso = '';

	if (isset($_POST['enviar'])){
		
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
			$id_filme = mysqli_real_escape_string($conn, $_POST['id_filme']);
			$num_sala = mysqli_real_escape_string($conn, $_POST['num_sala']);
			$horario = mysqli_real_escape_string($conn, $_POST['horario']);
			$dt_sessao = mysqli_real_escape_string($conn, $_POST['dt_sessao']);
			$qtdAssentosDisponiveis = mysqli_real_escape_string($conn, $_POST['qtdAssentosDisponiveis']);
			$valorIngresso = mysqli_real_escape_string($conn, $_POST['valorIngresso']);

			//criando a query
			$sql = "INSERT INTO sessao(id_filme, num_sala, horario, dt_sessao, qtdAssentosDisponiveis, valorIngresso) VALUES('$id_filme', '$num_sala', '$horario', '$dt_sessao', '$qtdAssentosDisponiveis', '$valorIngresso')";

			//salva no banco de dados
			if (mysqli_query($conn, $sql)){
				//sucesso
				$message = "Sessão cadastrada com sucesso!";
				echo "<script type='text/javascript'>alert('$message');</script>";
				$id_filme = $num_sala = $horario = $dt_sessao = $qtdAssentosDisponiveis = $valorIngresso = '';
			} else {
				echo 'query_error: '.mysqli_error($conn);
			}
		}
	}
?>


<!DOCTYPE html>
<html>
	<?php include('../templates/header.php')?>
	
	<section class="container grey-text padding">
		<div class="card-panel">
			<h4 class="center">Cadastrar Nova Sessão</h4>
		</div>
		<form action="adicionar_sessao.php" method="POST" >
			<br><br>
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