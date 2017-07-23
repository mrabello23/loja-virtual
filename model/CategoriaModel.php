<?php
require_once 'BD/MYSQL.php';

class CategoriaModel {
	private $bd;

	function __construct(){
		$this->bd = new MYSQL("localhostMYSQL"); 
	}
}