<?php 

require "config.php";

if ( isset($_POST["login"]) && isset($_POST["senha"]) && !empty($_POST["login"]) && !empty($_POST["senha"]) ) {

	$login = strip_tags($_POST["login"]);
	$senha = strip_tags($_POST["senha"]);

	$sql = " SELECT * FROM usuarios WHERE login = ".$login ." AND senha = ".$senha;
	$query = mysql_query($query);

	if ( mysql_num_rows($query) > 0 ) {

		$dados = mysql_fetch_object($query);
			
		$_SESSION["auth"]  = true;
		$_SESSION["nome"]  = $dados[0]->nome;
		$_SESSION["login"] = $dados[0]->email;
		$_SESSION["ativo"] = $dados[0]->fl_ativo;
		$_SESSION["tipo"]  = $dados[0]->tipo;

		header('Location: view/' );
	} else {
		$_SESSION['msg_tipo'] = 'Erro';
		$_SESSION['msg'] = 'Login ou senha inválido!';
		header('Location: index.php' );
	}
} else {

	$_SESSION['msg_tipo'] = 'Erro';
	$_SESSION['msg'] = 'Preencha os campos de Email e Senha corretamente!';
	header('Location: index.php' );
}