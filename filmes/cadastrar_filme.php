<?php

  include('../config/conexao.php');
  
  //Query para buscar
  $sql = 'SELECT id, tituloFilme, descricao, nomeImagem, is_cartaz FROM filme ORDER BY criadoem';
  
  //Armazena os resultados da buscar
  $resultados = mysqli_query($conn,$sql);
  
  //Pega os resultados e coloca em um vetor
  $filmes = mysqli_fetch_all($resultados,MYSQLI_ASSOC);
  
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
			height: 500px !important;
		}
	</style>

	<div class="container padding center">
		<a href="adicionar_filme.php" class="waves-effect waves-light btn"><i class="fas fa-plus"></i> Adicionar Novo Filme</a><br><br>
		
		<div class="card-panel">
            <h5 class="center-align"><b>FILMES CADASTRADO NO BANCO DE DADOS</b></h5>
        </div>
        <div class="row">
            
            <?php foreach($filmes as $filme){?>
                <div class="col">
                    <div class="card">
                        <div class="padding">
                            <a href="alterar_filme.php?id_filme=<?php echo $filme['id']?>" name="id_filme" class="waves-effect waves-light btn"><i class="fas fa-pencil-alt"></i></a>
                            <a href="deletar_filme.php?id_filme=<?php echo $filme['id']?>&tituloFilme=<?php echo $filme['tituloFilme']?>" name="id_filme" class="waves-effect waves-light btn"><i class="fas fa-trash"></i></a>
                        </div>
                        <div class="card-image">
                            <img src="../images/<?php echo $filme['nomeImagem']?>.jpg">
                        </div>
                        <div class="card-content">
                            <p><b><?php echo $filme['tituloFilme']?></b></p><br>
                        </div>

                    </div>
                </div>
            <?php } ?>
            
        </div>
	</div>

	<?php include('../templates/footer.php')?>
</html>