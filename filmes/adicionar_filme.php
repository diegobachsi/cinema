<?php

	include('../config/conexao.php');

	$erros = array('tituloFilme'=>'','descricao'=>'','nomeImagem'=>'', 'is_cartaz'=>'');
	$tituloFilme = $descricao = $nomeImagem = $is_cartaz = '';

	if (isset($_POST['enviar'])){
		
		//Verificar tituloFilme
		if (empty($_POST['tituloFilme'])){
			$erros['tituloFilme'] = 'O título do Filme é obrigatório';
		} else{
			$tituloFilme = $_POST['tituloFilme'];	
		}
		
		//Verifica descricao
		if (empty($_POST['descricao'])){
			$erros['descricao'] = 'Descrição é obrigatório <br/>';
		} else{
			$descricao = $_POST['descricao'];
		}
		
        //Verifica nomeImagem
		if (empty($_POST['nomeImagem'])){
			$erros['nomeImagem'] = 'Informe o nome da Imagem do filme <br/>';
		} else{
			$nomeImagem = $_POST['nomeImagem'];
		}

		//Verifica is_cartaz
		if (empty($_POST['is_cartaz'])){
			$erros['is_cartaz'] = 'Informe S para SIM ou N para NÃO <br/>';
		} else{
			$is_cartaz = $_POST['is_cartaz'];
			if (!preg_match('/^[sSnN]{1}$/',$is_cartaz)){
				$erros['is_cartaz'] =  'Apenas S ou N </br>';
				$is_cartaz = '';
			}		
		}
		
		if (array_filter($erros)){
			//echo 'Erro no formulário <br/>';
		}else {
			//limpando códigos suspeitos
			$tituloFilme = mysqli_real_escape_string($conn, $_POST['tituloFilme']);
			$descricao = mysqli_real_escape_string($conn, $_POST['descricao']);
			$nomeImagem = mysqli_real_escape_string($conn, $_POST['nomeImagem']);
			$is_cartaz = mysqli_real_escape_string($conn, $_POST['is_cartaz']);

			//criando a query
			$sql = "INSERT INTO filme(tituloFilme, descricao, nomeImagem, is_cartaz) VALUES('$tituloFilme', '$descricao', '$nomeImagem', '$is_cartaz')";

			//salva no banco de dados
			if (mysqli_query($conn, $sql)){
				//sucesso
				header('Location: http://localhost/cinema/index.php');
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
			<h4 class="center">Cadastrar Novo Filme</h4>
		</div>
		<form action="adicionar_filme.php" method="POST" >
			<br><br>
			<input placeholder="Título do Filme" type="text" name="tituloFilme" value="<?php echo $tituloFilme?>">
			<div class="red-text"><?php echo $erros['tituloFilme'].'<br/>'?></div>

			<input placeholder="Descrição" type="text" name="descricao" value="<?php echo $descricao?>">
			<div class="red-text"><?php echo $erros['descricao'].'<br/>'?></div>

			<input placeholder="Nome da Imagem" type="text" name="nomeImagem" value="<?php echo $nomeImagem?>">
			<div class="red-text"><?php echo $erros['nomeImagem'].'<br/>'?></div>

			<input placeholder="Filme está em Cartaz?" type="text" name="is_cartaz" value="<?php echo $is_cartaz?>">
			<div class="red-text"><?php echo $erros['is_cartaz'].'<br/>'?></div>


			<div class="center" style="margin-top: 10px;">
				<input type="submit" name="enviar" value="Enviar" class="btn brand z-depth-0">
			</div>
		</form>
	</section>
	<?php include('../templates/footer.php')?>
</html>