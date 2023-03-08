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
			height: 850px !important;
		}
	</style>

	<div class="container padding center">
		<a href="adicionar_sessao.php" class="waves-effect waves-light btn"><i class="fas fa-plus"></i> Adicionar Nova Sessão</a><br><br>
		
		<div class="card-panel">
            <h5 class="center-align"><b>SESSÕES CADASTRADAS NO BANCO DE DADOS</b></h5>
        </div>
        <div class="row">
            
            <?php foreach($sessoes as $sessao){?>
                <div class="col">
                    <div class="card">
                        <div class="padding">
                            <a href="alterar_sessao.php?id_sessao=<?php echo $sessao['numero']?>" name="id_sessao" class="waves-effect waves-light btn"><i class="fas fa-pencil-alt"></i></a>
                            <a href="deletar_sessao.php?id_sessao=<?php echo $sessao['numero']?>&tituloFilme=<?php echo $sessao['tituloFilme']?>" name="id_sessao" class="waves-effect waves-light btn"><i class="fas fa-trash"></i></a>
                        </div>
                        <div class="card-image">
                            <img src="../images/<?php echo $sessao['nomeImagem']?>.jpg">
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