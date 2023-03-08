<head>
	<title>CINE Web</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<style>
		.brand{
			background:  #483D8B !important;
			color: #fff;
		}
		.brand-text{
			color: #483D8B !important;
			font-size: 30px !important;
		}
		.fa-film{
			color: #483D8B !important;
			font-size: 50px !important;
			padding-top: 7px;
		}
		nav{
			height: 100px;
			border-bottom: 15px solid #483D8B;
			padding-top: 12px;
		}

		.col{
			width: 25% !important;
		}

		.card{
			width: 100% !important;
			height: 720px !important;
		}

		.padding{
			padding: 30px !important;
		}
		.margin{
			margin: 10px !important;
		}
		.center{
			text-align: center !important;
		}
		input::placeholder {
  			color: #aaa !important;
		}
	</style>
</head>
<body class="grey lighten-4">
	<nav class="white z-depth-0"> 
		<div class="container">
			<a href="http://localhost/cinema/index.php" class="brand-logo brand-text left"><i class="fas fa-film"></i> CINE Web</a>
			<ul id="nav-mobile" class="right hide-on-small-and-down">
				<li><a href="http://localhost/cinema/filmes/cadastrar_filme.php" class="btn brand z-depth-0">CADASTRAR FILME</a></li>
				<li><a href="http://localhost/cinema/sessao/cadastrar_sessao.php" class="btn brand z-depth-0">CADASTRAR SESSÃO</a></li>
				<li><a href="http://localhost/cinema/ingresso/comprar_ingresso.php" class="btn brand z-depth-0">COMPRAR INGRESSO</a></li>
			</ul>
		</div>
	</nav>