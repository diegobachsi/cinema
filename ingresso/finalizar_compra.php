<?php

  include('../config/conexao.php');

  $num_assento = $_GET['num_assento'];

  $num_sessao = $_GET['num_sessao'];
  
  //Query para buscar
  $sql = "SELECT s.numero, s.id_filme, s.num_sala, s.horario, s.dt_sessao, s.qtdAssentosDisponiveis, s.valorIngresso, s.id_filme, f.tituloFilme, f.nomeImagem FROM sessao s INNER JOIN filme f ON s.id_filme = f.id WHERE s.numero = '$num_sessao'";

  //Armazena os resultados da buscar
  $resultados = mysqli_query($conn,$sql);
  
  //Pega os resultados e coloca em um vetor
  $sessoes = mysqli_fetch_all($resultados,MYSQLI_ASSOC);

  //Limpa o resultado da buscar
  mysqli_free_result($resultados);

  //criando a query
  $sql = "INSERT INTO vendas(num_sessao, assento_vendido) VALUES('$num_sessao', '$num_assento')";

  //salva no banco de dados
  if (mysqli_query($conn, $sql)){
      //sucesso
      
  } else {
      echo 'query_error: '.mysqli_error($conn);
  }

  //Fechar conexão
  mysqli_close($conn);
  
?>

<!DOCTYPE html>
<html>
	<?php include('../templates/header.php')?>
	
	<style>
		.card{
            background: #FBE8A6;
			height: 650px !important;
		}
        .container2{
            float: right !important;
        }
	</style>

	<div class="container padding center">
		
		<div class="card-panel">
            <h5 class="center-align"><b>IMPRIMIR INGRESSO</b></h5>
        </div>
        <div class="row">
            
            <?php foreach($sessoes as $sessao){?>
                <div class="col">
                    <div class="card">
                        <div class="card-image">
                            
                        </div>
                        <div class="card-content">
                            <p><?php echo "Sessão: <b>".$sessao['numero']?></b></p><br>
                            <p><?php echo "Filme da Sessão: <b>".$sessao['tituloFilme']?></b></p><br>
                            <p><?php echo "SALA: <b>".$sessao['num_sala']?></b></p><br>
                            <p><?php echo "Assento: <b>".$num_assento?></b></p><br>
                            <p><?php echo "HORÁRIO: <b>".$sessao['horario']?></b></p><br>
                            <p><?php echo "DATA: <b>".$sessao['dt_sessao']?></b></p><br>
                            <p><?php echo "Valor do Ingresso: <b>".$sessao['valorIngresso']?></b></p><br>
                            <i style="font-size: 100px;" class="fas fa-qrcode"></i>
                            <i style="font-size: 100px;" class="fas fa-barcode"></i>
                        </div>

                    </div>
                </div>
            <?php } ?>
            <div class="container2 padding margin">
                <i style="font-size: 100px;color: green;" class="fas fa-check"></i>
                <h5>Parabéns seu ingresso foi gerado com sucesso! </h5>
                <p>A Cine Web deseja para você um excelente filme e muita diversão! ;D</p>
            </div>
        </div>
	</div>

	<?php include('../templates/footer.php')?>
</html>