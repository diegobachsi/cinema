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

  //Fechar conexão
  mysqli_close($conn);
  
?>

<!DOCTYPE html>
<html>
	<?php include('../templates/header.php')?>
	
	<style>
		.card{
			height: 300px !important;
		}
	</style>

	<div class="container padding center">
		
		<div class="card-panel">
            <h5 class="center-align"><b>FINALIZANDO COMPRA</b></h5>
        </div>
        <div class="row">
            
            <?php foreach($sessoes as $sessao){?>
                <div class="col">
                    <div class="card">
                        <div class="card-image">
                            <img src="../images/<?php echo $sessao['nomeImagem']?>.jpg">
                        </div>
                        <div class="card-content">
                            
                        </div>

                    </div>
                </div>
                <br>
                <p><?php echo "Sessão: <b>".$sessao['numero']?></b></p>
                <p><?php echo "Filme da Sessão: <b>".$sessao['tituloFilme']?></b></p>
                <p><?php echo "SALA: <b>".$sessao['num_sala']?></b></p>
                <p><?php echo "Assento: <b>".$num_assento?></b></p>
                <p><?php echo "HORÁRIO: <b>".$sessao['horario']?></b></p>
                <p><?php echo "DATA: <b>".$sessao['dt_sessao']?></b></p>
                <p><?php echo "Valor do Ingresso: <b>".$sessao['valorIngresso']?></b></p>
            <?php } ?>
            
            <a href="finalizar_compra.php?num_assento=<?php echo $num_assento?>&num_sessao=<?php echo $num_sessao?>" class="waves-effect waves-light btn"><i class="fas fa-check"></i> Finalizar Compra</a>
        </div>
	</div>

	<?php include('../templates/footer.php')?>
</html>