
<?php
session_start();
ob_start();
	include_once '../banco/conexao.php';
  	$conectar = getConnection();


  	if (!empty($_POST['logar'])) {

  		$usuario = $_POST['usuario'];
  		$senha = $_POST['senha'];

  		$sql_usuario = "SELECT id_usuario, nome, usuario, senha 
                        FROM usuarios 
                        WHERE usuario =:usuario  
                        LIMIT 1";
        $busca_usuario = $conectar->prepare($sql_usuario);
        $busca_usuario->bindParam(':usuario', $usuario, PDO::PARAM_STR);
        $busca_usuario->execute();

        if(($busca_usuario) AND ($busca_usuario->rowCount() != 0)){
            $linha_usuario = $busca_usuario->fetch(PDO::FETCH_ASSOC);
            //var_dump($row_usuario);
            if($senha == $linha_usuario['senha']){
                $_SESSION['id_usuario'] = $linha_usuario['id_usuario'];
                $_SESSION['usuario'] = $linha_usuario['usuario'];
                $_SESSION['nome'] = $linha_usuario['nome'];
                
                header("Location: tela_listagem.php");
            }else{
                $_SESSION['msg'] = "<p style='color: #ff0000'>Erro: Usuário ou senha inválida!</p>";
            }
        }else{
            $_SESSION['msg'] = "<p style='color: #ff0000'>Erro: Usuário ou senha inválida!</p>";
        }
  	}




?>



<!DOCTYPE html>
<html>
<head>
	<title> LOGIN </title>

	<meta charset="utf-8">
	<!--<meta http-equiv="refresh" content="2">  Atualiza a página à cada nº segundos -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Design Responsivo -->

	<link rel="icon" type="image/x-icon" href="../imagens/login.png">

	<link rel="stylesheet" type="text/css" href="login.css">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">


</head>



<body>

	<div id="login">
		<img src="../imagens/usuario.png">

		<div id="form">
		<form action="" method="POST">
			
			<p>
			<label>Usuário</label>
			<input type="text" name="usuario" class="form-control"  id="form-control"> 
			</p>

			<p>
			<label>Senha</label>
			<input type="password" name="senha" class="form-control" id="form-control">
			</p>

			<p id="btn-form">
				<input type="submit" name="logar" value="Fazer Login"  class="btn btn-light" style="width: 150px; height: 50px; border-radius: 25px;">
				<input type="reset" name="Limpar" class="btn btn-light"  style="width: 150px; height: 50px; border-radius: 25px;">
			</p>
		</form>
		</div>
	</div>


</body>



</html>