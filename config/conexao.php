<?php
  $conn = mysqli_connect('localhost','bd_cinema','123456','cinema');
  
  if (!$conn){
	  echo 'Erro na conexão: '.mysqli_connect_error(); 
  }
?>