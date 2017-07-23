<?php
	include "../../config.php";
	include "../../incs/cabecalho.php";
	include "../../incs/menu_superior.php";

	$produto = array(
		array(
			"id" 		 => 1,
			"nome" 		 => "produto 1",
			"modelo" 	 => "modelo 1",
			"marca" 	 => "marca 1",
			"quantidade" => 1,
			"valor" 	 => 200
		),
		array(
			"id" 		 => 2,
			"nome" 		 => "produto 2",
			"modelo" 	 => "modelo 3",
			"marca" 	 => "marca 2",
			"quantidade" => 1,
			"valor" 	 => 150
		),
		array(
			"id" 		 => 3,
			"nome" 		 => "produto 3",
			"modelo" 	 => "modelo 2",
			"marca" 	 => "marca 3",
			"quantidade" => 2,
			"valor" 	 => 50
		),
	);

	// echo "<pre>"; print_r($produto); echo "</pre>";
?>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h2>Finalizar Pedido de Orçamento</h2><hr/>
	</div>

	<?php include "../../incs/menu_lateral.php"; ?>
	<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Produto</th>
					<th>Modelo</th>
					<th>Marca</th>
					<th>Quantidade</th>
					<th>Preço</th>
					<th>Total</th>
				</tr>
			</thead>
			<tbody>
				<?php if (!empty($produto)): ?>
					<?php foreach ($produto as $key => $value): ?>
						<tr>
							<td><?=$value["nome"];?></td>
							<td><?=$value["modelo"];?></td>
							<td><?=$value["marca"];?></td>
							<td>
								<?=str_pad($value["quantidade"], 2, "0", STR_PAD_LEFT);?>

								<div class="pull-right">
									<a href="<?=BASE_URL;?>acoes/carrinho.php?acao=remover&id=<?=$id;?>" class="btn btn-danger btn-xs">
										<span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span>
									</a>
									<a href="<?=BASE_URL;?>acoes/carrinho.php?acao=adicionar&id=<?=$id;?>" class="btn btn-success btn-xs">
										<span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
									</a>
								</div>
							</td>
							<td>R$ <?=number_format($value["valor"], 2, ',', '.');?></td>
							<td>R$ <?=number_format(($value["quantidade"] * $value["valor"]), 2, ',', '.');?></td>
						</tr>
					<?php endforeach; ?>
				<?php endif; ?>
				<tr>
					<td colspan="5">Total:</td>
					<td>R$ 1.000,00</td>
				</tr>
			</tbody>
		</table>

		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<a href="#" class="btn btn-primary pull-right">Finalizar Pedido de Orçamento</a>
			</div>
		</div>
	</div> <!-- /.col-md-10 -->
</div> <!-- /.row -->

<?php include "../../incs/rodape.php"; ?>