<?php 
	require "../../../config.php";
	include "../../../incs/cabecalho.php";
	include "../../../incs/menu_superior.php";

	$pagina = (isset($_GET['pg']) ? (int)$_GET['pg'] : 1);
	$url = "http://".$_SERVER["SERVER_NAME"] . $_SERVER["PHP_SELF"];

	$id = "";
	if (isset($_GET["id"])) {
		$id = strip_tags(addslashes($_GET["id"]));
	}

	$orcamentos = new Orcamento();
	$dados = $orcamentos->listar($url, $pagina, $id);
?>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h2>Meus Orçamentos</h2><hr/>
	</div>

	<?php include "../../../incs/menu_lateral.php"; ?>
	<div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
	</div> <!-- /.col-md-10 -->
	<div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
		<?php echo $dados["paginacao"]; ?>
	</div>
</div> <!-- /.row -->

<?php include "../../../incs/rodape.php"; ?>