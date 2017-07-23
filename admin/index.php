<?php include "../incs/cabecalho.php"; ?>

<style type="text/css" media="screen">
	body {
	    background-color: #ddd;
	}
	.login {
		margin-top: 10% !important;
		padding: 5px;
		width: auto;
		min-width: 320px;
		max-width: 400px;
		min-height: 300px;
		height: auto;
		background-color: #f3f3f3;
		margin:0 auto;
		border-radius: 10px;
		border: 1px solid ##c5c5c5;
	    text-align: center;
	}
	.login-inner {
		margin:0 auto;
		max-width: 380px;
		width: auto;
	}
	.login > h3 {
		margin-left: 5px;
		line-height: 35px;
	}
	.email {
		margin-bottom: 5px;
	}
	.password {
		margin-bottom: 5px;
	}
	.submit {
		margin-top: 5px;
	}
	.forgot {
		min-width:50px;
		width: 49%;
		/*float: right;*/
		margin-top: 20px;
	}
	@media (max-width: 320px) {
		.forgot {
			font-size: 9px;
			font-weight: 700;
			padding: 8px;
		}
	}

</style>

<div class="login">
	<h3><u>Administração de Loja Virtual</u></h3>
	<hr/>
	<?php session_start(); ?>
	<?php if ( isset($_SESSION['msg_tipo']) && isset($_SESSION['msg']) ): ?>
		<div class="alert alert-<?=($_SESSION['msg_tipo'] == "Erro" ? "danger" : "success");?> alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong><?=$_SESSION['msg_tipo'];?>:</strong> <?=$_SESSION['msg'];?>
		</div>
		<?php unset($_SESSION['msg_tipo']); unset($_SESSION['msg']); ?>
	<?php endif; ?>

	<form class="login-inner" action="entrar.php" method="POST">
		<input type="email" class="form-control email" id="email-input" placeholder="Digite o Email" name="login" />
		<input type="password" class="form-control password" id="password-input" placeholder="Digite a Senha" name="senha" />
		<input type="hidden" name="class" value="<?=base64_encode("Login");?>" />
		<input class="btn btn-block btn-lg btn-info submit" type="submit" value="Login" />
	</form>
	<a href="#" class="btn btn-sm btn-default forgot" id="recuperarSenha">Esqueceu a senha?</a>
</div>


<!-- MODAL RECUPERAÇÃO DE SENHA -->
<div class="modal fade" tabindex="-1" role="dialog" id="modal_recuperarSenha">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="recuperarSenha.php" method="POST" accept-charset="utf-8" id="formRecupSenha">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Recuperação de senha</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 form-group">
							<div class="alert alert-danger alert-dismissible hide alert-form" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<strong>Atenção!</strong> Preencha o campo de e-mail.
							</div>

							<label>Digite o E-mail cadastrado:</label>
							<input type="text" name="nm_email" class="form-control"/>
						</div> 
						<div class="col-md-12">
							<p>
								<b>* Atenção:</b> Dados de acesso serão enviados para o email informado apenas se o usuário já possuir cadastro na plataforma.
							</p>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
					<button type="submit" class="btn btn-primary">Enviar</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php include "../incs/rodape.php"; ?>