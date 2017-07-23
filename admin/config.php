<?php 
session_start();
 
// Bloqueio por IP
// if( $_SERVER['REMOTE_ADDR'] != 'NUMERO_IP' ) {
//     $_SESSION['msg'] = '<p class="erro">Acesso restrito!</p>';
//     header('Location: index.php' );
//     exit;
// } 
 
// Bloqueio por Autenticação
if( !stripos( $_SERVER['PHP_SELF'], "entrar.php" ) && !stripos( $_SERVER['PHP_SELF'], "recuperarSenha.php" ) ) {
    if( !isset( $_SESSION['auth'] ) ) {
    	$_SESSION['msg_tipo'] = 'Erro';
        $_SESSION['msg'] = '<p class="erro">Sessão expirada! Acesse novamente.</p>';
        header('Location: index.php' );
        exit;
    }
} 
 
define( 'REALPATH', realpath($_SERVER["DOCUMENT_ROOT"]) );
define( '_DS', DIRECTORY_SEPARATOR );

$self = explode("/", $_SERVER["PHP_SELF"]);

if ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on" ) {

    $base_url = "https://".$_SERVER["SERVER_NAME"]."/".$self[1]."/";
} else {

    $base_url = "http://".$_SERVER["SERVER_NAME"]."/".$self[1]."/";
}

require_once "../DB/conexao.php";