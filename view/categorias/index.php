<?php 
	include "../../config.php";
	include "../../incs/cabecalho.php";
	include "../../incs/menu_superior.php";

	/** Paginação */
	$pagina = (isset($_GET['pg']) ? (int)$_GET['pg'] : 1);
	$url = "http://".$_SERVER["SERVER_NAME"] . $_SERVER["PHP_SELF"];

	$produto = new Produto();
	$produtos = $produto->listarPorCategoria($url, $pagina, strip_tags(addslashes($_GET["categoria"])));

	// echo "<pre>"; print_r($produtos); echo "</pre>";
?>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h2>Categorias</h2><hr/>
	</div>

	<?php include "../../incs/menu_lateral.php"; ?>

	<div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
		<?php if (!empty($produtos["dados"])): ?>
			<?php foreach ($produtos["dados"] as $key => $value): ?>
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 box-produto">
					<div class="thumbnail">
						<a href="<?=BASE_URL;?>view/produtos/index.php?id=<?=$value["id_produto"];?>">
							<!-- <img src="<?=$value["imagem"]?>" alt=""> -->
							<!-- <img src="http://placehold.it/320x180" alt=""> -->
							<img src="<?=BASE_URL;?>imagens/produtos/320x180.png" alt="">
						</a>
						<div class="caption">
							<h4>
								<a href="<?=BASE_URL;?>view/produtos/index.php?id=<?=$value["id_produto"];?>">
									<?=ucwords(strtolower($value["nome"]));?>
								</a>
							</h4>
							<?php if (!empty($value["compativel"])): ?>
								<p>
									<ul class="list-unstyled">
										<li><strong>Compatibilidade:</strong></li>
										<?php foreach ($value["compativel"] as $kCompativel => $vCompativel): ?>
											<li>
												<?=ucwords(strtolower($vCompativel["montadora"]));?> - 
												<?=ucwords(strtolower($vCompativel["modelo"]));?>
											</li>
										<?php endforeach ?>
									</ul>
								</p>
							<?php endif ?>
							<h4>
								R$ <?=number_format(($value["preco_compra"] + ($value["preco_compra"] * ($value["margem"] / 100))), 2, ",", ",");?>
							</h4>
							<hr/>
							<div class="ratings">
								<p class="pull-right">
									<a href="<?=BASE_URL;?>acoes/carrinho.php?acao=adicionar&id=<?=$value["id_produto"];?>" class="btn btn-primary btn-sm">
										Adicionar
									</a>
								</p>
								<p><?=($value["quantidade"] > 0 ? "Produto em estoque" : "Produto esgotado");?></p>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
	</div> <!-- /.col-md-10 -->
	<div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
		<?php echo $produtos["paginacao"]; ?>
	</div>
</div> <!-- /.row -->

<?php include "../../incs/rodape.php"; ?>