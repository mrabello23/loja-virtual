<?php 
	include "config.php";
	include "incs/cabecalho.php";
	include "incs/menu_superior.php";

	/** Paginação */
	$pagina = (isset($_GET['pg']) ? (int)$_GET['pg'] : 1);
	$url = "http://".$_SERVER["SERVER_NAME"] . $_SERVER["PHP_SELF"];

	$produto = new Produto();
	$produtos = $produto->listar($url, $pagina);

	// echo "<pre>"; print_r($produtos); echo "</pre>";
?>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h2>Produtos em destaque</h2><hr/>
	</div>

	<?php include "incs/menu_lateral.php"; ?>

	<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
		<?php if (!empty($produtos["dados"])): ?>
			<?php foreach ($produtos["dados"] as $key => $value): ?>
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<div class="thumbnail">
						<a href="<?=BASE_URL;?>view/produtos/index.php?id=<?=$value["id_produto"];?>">
							<img src="<?=$value["imagem"]?>" alt="">
						</a>
						<div class="caption">
							<h4 class="pull-right">R$ 24,99</h4>
							<h4>
								<a href="<?=BASE_URL;?>view/produtos/index.php?id=<?=$value["id_produto"];?>">
									<?=ucwords(strtolower($value["nome"]));?>
								</a>
							</h4>
							<p>
								<ul class="list-unstyled">
									<li><strong>Montadora:</strong> <?=ucwords(strtolower($value["montadora"]));?></li>
									<li><strong>Modelo:</strong> <?=ucwords(strtolower($value["modelo"]));?></li>
									<li><strong>Categoria:</strong> <?=ucwords(strtolower($value["categoria"]));?></li>
								</ul>
							</p>
							<hr/>
							<div class="ratings">
								<p class="pull-right">
									<a href="<?=BASE_URL;?>acoes/carrinho.php?acao=adicionar&id=<?=$value["id_produto"];?>" class="btn btn-primary btn-sm">
										Adicionar
									</a>
								</p>
								<p> Produto em estoque </p>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
	</div> <!-- /.col-md-10 -->
	<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
		<?php echo $produtos["paginacao"]; ?>
	</div>
</div> <!-- /.row -->

<?php include "incs/rodape.php"; ?>