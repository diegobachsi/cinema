<?php

	include('../config/conexao.php');

    $erros = array('tituloFilme'=>'','descricao'=>'','nomeImagem'=>'', 'is_cartaz'=>'');

    $id_filme = $_GET['id_filme'];

    //Query para buscar
    $sql = "SELECT id, tituloFilme, descricao, nomeImagem, is_cartaz FROM filme WHERE id = '$id_filme' ";

    //Armazena os resultados da buscar
    $resultado_filme = mysqli_query($conn,$sql);
    
    //Pega os resultados e coloca em um vetor
    $row_filme = mysqli_fetch_assoc($resultado_filme);

    $id = $row_filme['id'];
    $tituloFilme = $row_filme['tituloFilme'];
    $descricao = $row_filme['descricao'];
    $nomeImagem = $row_filme['nomeImagem'];
    $is_cartaz = $row_filme['is_cartaz'];

    //Limpa o resultado da buscar
    mysqli_free_result($resultado_filme);
    
    //Fechar conexão
    mysqli_close($conn);

	if (isset($_POST['enviar'])){

        include('../config/conexao.php');

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
            $id = mysqli_real_escape_string($conn, $_POST['id']);
			$tituloFilme = mysqli_real_escape_string($conn, $_POST['tituloFilme']);
			$descricao = mysqli_real_escape_string($conn, $_POST['descricao']);
			$nomeImagem = mysqli_real_escape_string($conn, $_POST['nomeImagem']);
			$is_cartaz = mysqli_real_escape_string($conn, $_POST['is_cartaz']);

			//criando a query
			$sql = "UPDATE filme SET tituloFilme = '$tituloFilme', descricao = '$descricao', nomeImagem = '$nomeImagem', is_cartaz = '$is_cartaz' WHERE id = '$id'";

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
			<h4 class="center">Alterar Filme</h4>
		</div>
		<form action="alterar_filme.php" method="POST" >
			<br><br>
            <input type="hidden" name="id" value="<?php echo $id_filme?>">    

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