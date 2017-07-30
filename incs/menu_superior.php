<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbarCollapse" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?=BASE_URL;?>">Casa de Material do Ônibus</a>
		</div>

		<div class="collapse navbar-collapse" id="navbarCollapse">
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						<span class="glyphicon glyphicon-user" aria-hidden="true"></span> 
						Minha Conta <span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<?php if (isset($_SESSION["auth"]) && $_SESSION["auth"]): ?>
							<li><a href="<?=BASE_URL;?>admin/view/orcamentos/index.php">Meus orçamentos</a></li>
							<li><a href="<?=BASE_URL;?>admin/view/index.php?id=<?=$_SESSION["id"];?>">Atualizar informações</a></li>
							<li role="separator" class="divider"></li>
							<li>
								<a href="<?=BASE_URL;?>acoes/sair.php">
									<span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Sair
								</a>
							</li>
						<?php else: ?>
							<li>
								<a href="<?=BASE_URL;?>admin/view/index.php">
									<span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Entrar
								</a>
							</li>
						<?php endif; ?>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Carrinho de Produtos <span class="caret"></span>
						<?=(!empty($_SESSION["totalProduto"]) ? "<span class=\"badge\">".array_sum($_SESSION["totalProduto"])."</span>" : "");?>
					</a>
					<ul class="dropdown-menu">
						<?php if (!empty($_SESSION["nomeProduto"]) && !empty($_SESSION["totalProduto"])): ?>
							<?php foreach ($_SESSION["nomeProduto"] as $key => $value): ?>
								<li>
									<a href="#">
										<?=str_pad($_SESSION["totalProduto"][$key], 2, "0", STR_PAD_LEFT)." - ".ucwords(strtolower($value));?>
									</a>
								</li>
								<li role="separator" class="divider"></li>
								<li>
									<a href="<?=BASE_URL;?>view/produtos/carrinho.php">
										<span class="glyphicon glyphicon-check" aria-hidden="true"></span> Finalizar
									</a>
								</li>
							<?php endforeach; ?>
						<?php else: ?>
							<li>
								<a href="#">
									Sem produtos no carrinho.
								</a>
							</li>
						<?php endif; ?>
					</ul>
				</li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container -->
</nav>