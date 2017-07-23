<?php 
	require "../../config.php";
	include "../../incs/cabecalho.php";
	include "../../incs/menu_superior.php";

	$pagina = (isset($_GET['pg']) ? (int)$_GET['pg'] : 1);
	$url = "http://".$_SERVER["SERVER_NAME"] . $_SERVER["PHP_SELF"];

	$user = new Usuario();
	$dados = $user->listar('', false, $pagina, $url);
?>

<div class="row">
	<div class="col-md-12">
		<h2>Lista de Usuários</h2><hr />

		<?php if ( isset($_SESSION['msg_tipo']) && isset($_SESSION['msg']) ): ?>
			<div class="alert alert-<?=($_SESSION['msg_tipo'] == "Erro" ? "danger" : "success");?> alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong><?=$_SESSION['msg_tipo'];?>:</strong> <?=$_SESSION['msg'];?>
			</div>
			<?php unset($_SESSION['msg_tipo']); unset($_SESSION['msg']); ?>
		<?php endif; ?>

		<table class="table table-striped">
			<thead>
				<tr>
					<th>Nome</th>
					<th>Login</th>
					<th>Senha</th>
					<th>Ativo?</th>
					<th>Tipo</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($dados["dados"] as $value): ?>
					<tr <?=($value["fl_ativo"] != 1 ? "class='erro'" : "");?> >
						<td><?=utf8_encode($value["nome"]);?></td>
						<td><?=$value["email"];?></td>

						<?php if ($_SESSION['root'] == 1): ?>
							<td><?=$value["senha"];?></td>
						<?php else: ?>
							<td>Restrito ao admin</td>
						<?php endif; ?>

						<td><?=($value["fl_ativo"] == 1 ? "SIM" : "NÃO");?></td>
						<td><?=utf8_encode($value["tipo"]);?></td>

						<td>
							<?php if ( $_SESSION["root"] == 1 || ( isset($_SESSION["permissoes"][1]) && in_array($_SESSION["root"], $_SESSION["permissoes"][1]) ) ): ?>
							<div class="pull-right">
								<?php if ( $_SESSION["root"] == 1 || in_array(16, $_SESSION["permissoes"][1][ $_SESSION["root"] ]) ): ?>
								<a href="<?=$base_url."view/usuarios/adicionar.php?cd=".base64_encode($value["id_usuario"]);?>" title="Editar" data-toggle="tooltip" data-placement="top" class="btn btn-info btn-xs">
									<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
								</a>
								<?php endif; ?>

								<?php if ( $_SESSION["root"] == 1 || in_array(15, $_SESSION["permissoes"][1][ $_SESSION["root"] ]) ): ?>
								<a href="#" title="Excluir" rel="<?=$value["id_usuario"];?>" data-toggle="tooltip" data-placement="top" class="btn btn-danger btn-xs excluir">
									<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
								</a>
								<?php endif; ?>
							</div>
							<?php endif; ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

		<?=$dados["paginacao"];?>
	</div> <!-- /.col-md-12 -->
</div> <!-- /.row -->


<!-- MODAL CONFIRMAÇÃO DE EXCLUSÃO -->
<div class="modal fade" tabindex="-1" role="dialog" id="modal_confirmacao">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<form action="<?=$base_url."acoes/excluir.php";?>" method="POST" accept-charset="utf-8">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Confirmação de exclusão</h4>
				</div>
				<div class="modal-body">
					<p>
						<b>Atenção: </b><br />
						Deseja excluir o registro selecionado?
					</p>
					<input type="hidden" name="codigo" value="" id="codigo" />
					<input type="hidden" name="class" value="<?=base64_encode("Usuario");?>" />
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
					<button type="submit" class="btn btn-primary">Confirmar</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php include "../../incs/rodape.php"; ?>