<?php
	session_start();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Carrinho de compras PHP</title>
	<style type="text/css">
		*{margin: 0;padding: 0;box-sizing: border-box;}
		h2.title{
			background-color: #069;
			width: 100%;
			padding: 20px;
			text-align: center;
			color: white;
		}

		.carrinho-container{
			display: flex;
			margin-top: 10px;
		}

		.produto{
			width: 33.3%;
			padding: 0 30px;
		}

		.produto img{
			width: 500px;
			height: 300px;
		}

		.produto a{
			display: block;
			width: 100%;
			padding: 10px;
			color: white;
			background-color: #5fb382;
			text-align: center;
			text-decoration: nones;	
		}

	</style>
</head>
<body>
	<h2 class="title">Carrinho com PHP</h2>
	<div class="carrinho-container"> 
	<?php 

	$itens = array(['nome' => 'burgue1','imagem' => 'especial.jfif','preco' => '200'], ['nome' => 'burgue2','imagem' => 'x-burgue.jfif','preco' => '400'], ['nome' => 'burgue3','imagem' => 'x-salada.jpg','preco' => '400']);

	foreach ($itens as $key => $value) {
?>
	<div class="produto">
		<img src="<?php echo $value['imagem'] ?>" />
		<a href="?adicionar=<?php echo $key ?>"> Adicionar ao Carrinhho </a>

	</div><!--produto-->


<?php
		}	
?>

</div> <!--carrinho-container-->


<?php
	if (isset($_GET['adicionar'])) {
		// vamos adicionar ao carrinho
		$idProduto = (int) $_GET['adicionar'];
		if (isset($itens[$idProduto])) {
			if (isset($_SESSION['carrinho'][$idProduto])){
				$_SESSION['carrinho'][$idProduto]['quantidade']++;
			} else{
				$_SESSION['carrinho'][$idProduto] = array('quantidade'=>1, 'nome' =>$itens[$idProduto]['nome'],'preco' =>$itens[$idProduto]['preco']);
			}
			echo '<script> alert("O item foi adicionado ao carrinho");</script>';
		} else{
			die('Você não pode adicionar um produto que não existe.');
		}
	}
?>

<h2 class="title">Carrinho:</h2>

<?php
	foreach ($_SESSION['carrinho'] as $key => $value) {
		// Nome do produto
		// Quantidade
		// Preço

		echo '<p>Nome: '.$value['nome'].' | Quantide: '.$value['quantidade'].' | Preço: R$'.($value['quantidade']*$value['preco']).',00</p>';
	}
?>
</body>
</html>

