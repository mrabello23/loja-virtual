<?php 
	require "../../config.php";
	include "../../incs/cabecalho.php";
	include "../../incs/menu_superior.php";

	$action = "cadastrar";
	$divAtivo = "";
	$dados = array( 0 => array("nome" => '', "email" => '', "senha" => '', "tipo" => '', "id" => '', "id_tipo" => "") );

	$user  = new Usuario();
	$tipos = $user->listarTipos();

	if ( isset( $_GET["cd"] ) ) {
		$dados  = $user->listar( $_GET["cd"] );
		$action = "editar";

		$divAtivo = "
			<div class=\"col-md-3 form-group\">
				<label>Ativo: </label><br/>
				<input type=\"radio\" name=\"fl_ativo\" value=\"1\" ".($dados[0]["fl_ativo"] == 1 ? "checked" : "")." /> Sim
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input type=\"radio\" name=\"fl_ativo\" value=\"0\" ".($dados[0]["fl_ativo"] == 0 ? "checked" : "")." /> Não
			</div>
			<input type=\"hidden\" name=\"path\" value=\"".base64_encode("usuarios")."\" />
		";
	}
?>

<div class="row">
	<div class="col-md-12">
		<h2>Cadastrar Usuários</h2><hr />
		<div class="alert alert-danger alert-dismissible hide alert-form" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Atenção!</strong> Preencha todos os campos do formulário.
		</div>
	
		<?php if ( isset($_SESSION['msg_tipo']) && isset($_SESSION['msg']) ): ?>
			<div class="alert alert-<?=($_SESSION['msg_tipo'] == "Erro" ? "danger" : "success");?> alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong><?=$_SESSION['msg_tipo'];?></strong> <?=$_SESSION['msg'];?>
			</div>
			<?php unset($_SESSION['msg_tipo']); unset($_SESSION['msg']); ?>
		<?php endif; ?>

		<form action="<?=$base_url."acoes/".$action.".php";?>" method="POST" accept-charset="utf-8" id="formCadUser">
			<div class="col-md-4 form-group">
				<label for="nm_usuario">Nome: </label>
				<input type="text" name="nm_usuario" class="form-control" value="<?=$dados[0]["nome"];?>"/>
			</div>
			<div class="col-md-3 form-group">
				<label for="nm_senha">Senha: </label>
				<input type="text" name="nm_senha" class="form-control" id="senha_1" value="<?=$dados[0]["senha"];?>"/>
			</div>
			<div class="col-md-3 form-group">
				<label for="senha_2" class="control-label">Confirmar senha: </label>
				<input type="text" class="form-control" id="senha_2" aria-describedby="helpBlock" value="<?=$dados[0]["senha"];?>"/>
				<span id="helpBlock" class="hide help-block">Senhas não conferem</span>
			</div>
			<div class="col-md-4 form-group">
				<label for="nm_email">E-mail / Login: </label>
				<input type="text" name="nm_email" class="form-control" value="<?=$dados[0]["email"];?>"/>
			</div>
			<div class="col-md-3 form-group">
				<label for="tipo">Tipos: </label><br/>
				<select name="tipo" class="form-control">
					<option value="">.:Selecione:.</option>
					<?php foreach ($tipos as $key => $value): ?>
						<?php 
							if ($_SESSION["root"] != 1 && $value["id"] == 1):
								continue;
							endif; 
						?>
						<option value="<?=$value["id"];?>" <?=($dados[0]["id_tipo"] == $value["id"] ? "selected" : "");?> ><?=utf8_encode($value["nome"]);?></option>
					<?php endforeach; ?>
				</select>
			</div>

			<?=$divAtivo;?>

			<input type="hidden" name="codigo" value="<?=base64_encode($dados[0]["id_usuario"]);?>" />
			<input type="hidden" name="class" value="<?=base64_encode("Usuario");?>" />
			<div class="col-md-12">
				<input type="submit" value="Cadastrar" class="btn btn-primary" id="cadastrar"/>
			</div>
		</form>
	</div>
</div>

<?php include "../../incs/rodape.php"; ?>