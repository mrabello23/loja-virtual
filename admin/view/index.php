<?php 
	require "../config.php";
	include "../../incs/cabecalho.php";
	include "../../incs/menu_superior.php";

	// echo "<pre>"; print_r($_SESSION["permissoes"]); echo "</pre>";
?>

<div class="row">
	<div class="col-md-12">
		<h2>Gerenciamento de Loja Virtual</h2><hr /> <br />
		<p>
			<b><?=$_SESSION['nome'];?></b>, seja bem vindo ao sistema.  <br /> <br /> <br />

			<b>Instruções de uso: </b><br />
			- Sua senha é pessoal e não deve ser divulgada a outros usuários <br />
			- Sempre navegue pelo site usando o menu superior 
		</p>
	</div>
</div>

<?php include "../../incs/rodape.php"; ?>