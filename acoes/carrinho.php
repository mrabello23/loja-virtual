<?php 
require_once "../config.php";

$id = strip_tags(addslashes($_GET["id"]));
$acao = strip_tags($_GET["acao"]);

$produtos = new Produto();
$produto = $produtos->listar("", 0, $id);

if (!empty($produto[0])) {
	$_SESSION["nomeProduto"][$id] = $produto[0]["nome"];

	switch ($acao) {
		case "adicionar":
			$_SESSION["totalProduto"][$id]++;
		break;
		case "remover":
			if ($_SESSION["totalProduto"][$id] > 0) {
				$_SESSION["totalProduto"][$id]--;
			}
		break;
		case "limpar":
			$_SESSION["totalProduto"][$id] = 0;
		break;
	}
}

header("Location:".$_SERVER["HTTP_REFERER"]);