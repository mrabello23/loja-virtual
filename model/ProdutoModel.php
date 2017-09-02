<?php
require_once 'BD/MYSQL.php';

class ProdutoModel {
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
			"SELECT p.*, 
				(SELECT c.nome FROM categoria c WHERE c.id_categoria = p.id_categoria) AS categoria, 
				(SELECT i.foto FROM imagem i WHERE i.id_imagem = p.id_imagem) AS imagem 
			FROM produto p 
			WHERE p.ativo = 1 
			AND p.mostra_vitrine = 1 " . $condicao
		);
	}

	public function listarPorCategoria($categoria){
		return $this->bd->query(
			"SELECT p.*, 
				m.nome AS modelo, 
				(SELECT c.nome FROM categoria c WHERE c.id_categoria = p.id_categoria) AS categoria, 
				(SELECT i.foto FROM imagem i WHERE i.id_imagem = p.id_imagem) AS imagem, 
			FROM produto p 
			WHERE p.ativo = 1 
				AND p.mostra_vitrine = 1 
				AND p.id_categoria = " . $categoria
		);
	}

	public function salvarOrcamento($dados, $id = ""){
		if (!empty($id)) {
			return $this->bd->alterar("produto_orcamento", $dados, array("id_produto" => $id));
		}

		return $this->bd->salvar("produto_orcamento", $dados);
	}

	public function listarPorMontadora($idProduto){
		return $this->bd->query(
			"SELECT mt.nome AS montadora, 
				m.nome AS modelo 
			FROM modelo m, 
				produto_modelo pm, 
				montadora mt 
			WHERE m.id_montadora = mt.id_montadora 
				AND m.id_modelo  = pm.id_modelo 
				AND m.ativo  = 1 
				AND mt.ativo = 1 
				AND pm.id_produto = " . $idProduto
		);
	}
}