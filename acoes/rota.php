<?php 
require_once "../config.php";

$_SESSION['msg_tipo'] = 'Erro';
$_SESSION['msg'] = 'Ocorreu um erro ao alterar os dados.';

if(isset($_POST) && !empty($_POST['class']) && !empty($_POST['method']) && !empty($_POST['path'])){
	$class = strip_tags(base64_decode($_POST['class']));
	$method = strip_tags(base64_decode($_POST["method"])); 
	$path = strip_tags(base64_decode($_POST['path']));

	unset($_POST['class']);
	unset($_POST["method"]);
	unset($_POST['path']);

	$dados = new $class();
	$retorno = $dados->$method($_POST);

	if($retorno){
		$_SESSION['msg_tipo'] = 'Sucesso';
		$_SESSION['msg'] = $class.' alterado!';
	}
}

header("Location:".$base_url."view/".$path."/");