<?php
/**
* 
*/
class Orcamento {
	private $model;
	private $utils;

	function __construct(){
		$this->model = new OrcamentoModel();
		$this->utils = new Utils();
	}

	public function listar($url = "", $pagina = 0, $id = ""){
		$dados = array();
		$dados["dados"] = $this->model->listar($id);

		/** Paginação */
		if (!empty($url)) {
			$inicio = 1;
			$limite = 12;
			$totalPorPagina = 12;

			if ($pagina > 1) {
				$limite = $pagina * $limite;
				$inicio = $limite - ($totalPorPagina - 1);
			}

			$dados["paginacao"] = $this->utils->paginacao($url, $inicio, count($dados["dados"]), $limite);
		}

		return $dados;
	}
}