<?php
require_once 'BD/MYSQL.php';

class OrcamentoModel {
	private $bd;

	function __construct(){
		$this->bd = new MYSQL("localhostMYSQL"); 
	}

	public function listar($id = ""){
		$condicao = "";

		if (!empty($id)) {
			$condicao = " AND p.id_produto = ".$id;
		}

		return $this->bd->query(
			"SELECT p.*, v.*, 
				DATE_FORMAT(v.data, \"%d/%m/%Y %T\") AS datavenda,
				iv.quantidade,
				(SELECT c.nome FROM categoria c WHERE c.id_categoria = p.id_categoria) AS categoria
			FROM 
				produto p,
				item_venda iv,
				venda v
			WHERE p.id_produto = iv.id_produto
				AND v.id_venda = iv.venda_id_venda" . $condicao
		);
	}

	public function salvar($dados, $id = ""){
		if (!empty($id)) {
			return $this->bd->alterar("orcamento", $dados, array("id" => $id));
		}

		return $this->bd->salvar("orcamento", $dados);
	}
}