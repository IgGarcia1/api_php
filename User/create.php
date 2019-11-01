<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST"); // "Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE"
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once('../dao/UserDAO.php');

$pre_dados = file_get_contents("php://input");
if (isset($pre_dados) && $pre_dados!=null){
	$dados = json_decode($pre_dados, true);
	var_dump($dados);
}else{
	print_r(json_encode( array('msg' => "Dados inválidos")));
}
