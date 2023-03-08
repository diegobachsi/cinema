<?php

  include('config/conexao.php');
  
  //Query para buscar
  $sql = 'SELECT id, tituloFilme, descricao, nomeImagem FROM filme WHERE is_cartaz = "S" ORDER BY criadoem';
  
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
	<?php include('templates/header.php')?>

    <div class="container padding">
        <div class="card-panel">
            <h5 class="center-align"><b>FILMES EM CARTAZ</b></h5>
        </div>
        <div class="row">
            
            <?php foreach($filmes as $filme){?>
                <div class="col">
                    <div class="card">
                        <div class="card-image">
                            <img src="images/<?php echo $filme['nomeImagem']?>.jpg">
                            <a class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons"><i class="fas fa-chevron-circle-right"></i></i></a>
                        </div>
                        <div class="card-content">
                            <p><b><?php echo $filme['tituloFilme']?></b></p><br>
                            <p><?php echo $filme['descricao']?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
            
        </div>
    </div>
	<?php include('templates/footer.php')?>
</html>