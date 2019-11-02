<?php


include_once("./headers.php");
require_once('../dao/UserDAO.php');

$pre_dados = file_get_contents("php://input");
if (isset($pre_dados) && $pre_dados!=null){
	$dados = json_decode($pre_dados, true);
	
	//print_r ($dados);

	$user = new UserDAO();
	$r = $user->update($dados); 
	print_r($r);

}else{
	print_r(json_encode( array('msg' => "Error. Dados inválidos")));
}
die();