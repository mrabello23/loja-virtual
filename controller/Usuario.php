<?php
/**
* 
*/
class Usuario {
	private $model;
	private $utils;

	function __construct(){
		$this->model = new UsuarioModel();
		$this->utils = new Utils();
	}

	public function entrar($usuario, $senha){
		return $this->model->entrar(
			$usuario, $senha
		);
	}

	public function recuperarSenha(){

	}

	public function listarId($id){
		return $this->model->listarId(
			$this->utils->validarDados($id)
		);
	}

	public function salvar($dados){
		if ($dados["senha"] != $dados["confirmacaoSenha"]) {
			$_SESSION['msg_tipo'] = 'Erro';
			$_SESSION['msg'] = 'Senhas não conferem.';

			return false;
			exit;
		}

		$cpfCnpj = preg_replace("/[^0-9]/", "", $dados["cpfCnpj"]);
		if (strlen($cpfCnpj) > 11) {
			$valida = $this->utils->validarCnpj($cpfCnpj);
			$tipo = 2; // Juridica
		} else {
			$valida = $this->utils->validarCPF($cpfCnpj);
			$tipo = 1; // Fisica
		}

		if ($valida === false) {
			$_SESSION['msg_tipo'] = 'Erro';
			$_SESSION['msg'] = 'CPF / CNPJ Inválido.';

			return false;
			exit;
		}

		$salvar = array(
			"nome" 	=> $dados["nome"],
			"email" => $dados["email"],
			"senha" => $dados["senha"],
			"cpf" 	=> $dados["cpfCnpj"],
			"tipo"	=> $tipo,
			"ativo" => true
		);

		if (!empty($dados["codigo"])) {
			return $this->model->alterar($salvar, $dados["codigo"]);
		}

		$idCliente = $this->model->salvar($salvar);

		if ($idCliente && $dados["telefone"]) {
			$salvarContato = array(
				"numero" 	=> $dados["telefone"],
				"idCliente" => $idCliente,
				"tipo" 		=> ""
			);

			return $this->model->salvarContato($salvarContato);
		}

		return $idCliente;
	}
}