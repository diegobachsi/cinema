<?php

    $numero = $_GET['id_sessao'];
    $tituloFilme = $_GET['tituloFilme'];

?>

<!DOCTYPE html>
<html>
	<?php include('../templates/header.php')?>
	
    <div class="container padding">
        <div class="card-panel">
            <h5 class="center-align">Tem certeza que deseja deletar a Sessão <b><?php echo $numero?></b> com o filme <b><?php echo $tituloFilme?></b> em cartaz?</h5>
            
            <div class="center padding" style="margin-top: 10px;">
				<a href="proc_deletar_sessao.php?id_filme=<?php echo $numero?>">
                    <input type="submit" name="sim" value="Sim" class="waves-effect waves-light btn">
                </a>
                <a href="#">
                    <input type="submit" name="nao" value="Não" class="waves-effect waves-light btn">
                </a>
            </div>

        </div>
    </div>	    

	<?php include('../templates/footer.php')?>
</html>