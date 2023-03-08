<?php

  include('../config/conexao.php');
  
  //Query para buscar
  $sql = "SELECT s.numero, s.id_filme, s.num_sala, s.horario, s.dt_sessao, s.qtdAssentosDisponiveis, s.valorIngresso, s.id_filme, f.tituloFilme, f.nomeImagem FROM sessao s INNER JOIN filme f ON s.id_filme = f.id";

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
			height: 750px !important;
		}
	</style>

	<div class="container padding center">
		
		<div class="card-panel">
            <h5 class="center-align"><b>COMPRAR INGRESSOS - SESSÕES ABERTAS</b></h5>
        </div>
        <div class="row">
            
            <?php foreach($sessoes as $sessao){?>
                <div class="col">
                    <div class="card">
                        <div class="card-image">
                            <img src="../images/<?php echo $sessao['nomeImagem']?>.jpg">
                            <a href="selecionar_assento.php?id_sessao=<?php echo $sessao['numero']?>&num_sala=<?php echo $sessao['num_sala']?>" class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons"><i class="fas fa-ticket-alt"></i></i></a>
                        </div>
                        <div class="card-content">
                            <p><?php echo "Sessão: <b>".$sessao['numero']?></b></p><br>
                            <p><?php echo "Filme da Sessão: <b>".$sessao['tituloFilme']?></b></p><br>
                            <p><?php echo "SALA: <b>".$sessao['num_sala']?></b></p><br>
                            <p><?php echo "HORÁRIO: <b>".$sessao['horario']?></b></p><br>
                            <p><?php echo "DATA: <b>".$sessao['dt_sessao']?></b></p><br>
                            <p><?php echo "QTD. Assentos Disponíveis: <b>".$sessao['qtdAssentosDisponiveis']?></b></p><br>
                            <p><?php echo "Valor do Ingresso: <b>".$sessao['valorIngresso']?></b></p><br>
                        </div>

                    </div>
                </div>
            <?php } ?>
            
        </div>
	</div>

	<?php include('../templates/footer.php')?>
</html>