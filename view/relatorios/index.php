
<?php 
	require "../../config.php";
	include "../../incs/cabecalho.php";
	include "../../incs/menu_superior.php";

	$site = new GrupoAcesso();
	$action = "cadastrar";
	$dados = array( 0 => array("nome" => '') );

	if ( isset( $_GET["cd"] ) ) {
		$dados = $site->listar( $_GET["cd"] );
		$action = "editar";
	}
?>

<div class="row">
	<div class="col-md-12">
		<h2>Relatórios</h2><hr />
	
		<?php if ( isset($_SESSION['msg_tipo']) && isset($_SESSION['msg']) ): ?>
			<div class="alert alert-<?=($_SESSION['msg_tipo'] == "Erro" ? "danger" : "success");?> alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong><?=$_SESSION['msg_tipo'];?></strong> <?=$_SESSION['msg'];?>
			</div>
			<?php unset($_SESSION['msg_tipo']); unset($_SESSION['msg']); ?>
		<?php endif; ?>

		<?php echo "TO DO REPORTS VIEW"; ?>
	</div>
</div>

<?php include "../../incs/rodape.php"; ?>