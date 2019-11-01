<?php


header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UTF-8");
//header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
//header("Access-Control-Max-Age: 3600");
//header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


require_once('../dao/UserDAO.php');
var_dump($_POST);

if (isset($_POST) && $_POST != null){
	$dados = json_decode($_POST);
	var_dump($dados);
}else{
	echo "Pagina no ar";
}
