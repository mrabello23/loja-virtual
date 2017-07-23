<?php
require_once 'BD/MYSQL.php';

class UsuarioModel {
	private $bd;

	function __construct(){
		$this->bd = new MYSQL("localhostMYSQL"); 
	}
}