<?php

class Produto {
	private $model;
	private $utils;

	function __construct(){
		$this->model = new ProdutoModel();
		$this->utils = new Utils();
	}

	public function listar($url, $pagina, $id = ""){
		$dados = array();

		/** Paginação */
		$inicio = 1;
		$limite = 12;
		$totalPorPagina = 12;

		if ($pagina > 1) {
			$limite = $pagina * $limite;
			$inicio = $limite - ($totalPorPagina - 1);
		}

		$dados["dados"] = $this->model->listar($id);
		$dados["paginacao"] = $this->utils->paginacao($url, $inicio, count($dados["dados"]), $limite);

		return $dados;
	}

	public function listarPorCategoria($url, $pagina, $categoria){
		$dados = array();

		/** Paginação */
		$inicio = 1;
		$limite = 12;
		$totalPorPagina = 12;

		if ($pagina > 1) {
			$limite = $pagina * $limite;
			$inicio = $limite - ($totalPorPagina - 1);
		}

		$dados["dados"] = $this->model->listarPorCategoria($categoria);
		$dados["paginacao"] = $this->utils->paginacao($url, $inicio, count($dados["dados"]), $limite);

		return $dados;
	}
}