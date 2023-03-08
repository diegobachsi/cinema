<?php

    $id_filme = $_GET['id_filme'];
    $tituloFilme = $_GET['tituloFilme'];

?>

<!DOCTYPE html>
<html>
	<?php include('../templates/header.php')?>
	
    <div class="container padding">
        <div class="card-panel">
            <h5 class="center-align">Tem certeza que deseja deletar o Filme <b><?php echo $tituloFilme?></b>?</h5>
            
            <div class="center padding" style="margin-top: 10px;">
				<a href="proc_deletar_filme.php?id_filme=<?php echo $id_filme?>">
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