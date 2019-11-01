<?php

require('../connectionDB.php');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


class User{
	
	

	function create($objetoDados){

		$nome = $objetoDados->nome;
		$usuario = $objetoDados->usuario;
		$email = $objetoDados->email;
		$senha = md5($objetoDados->senha);

		$sql = "insert into tbl_usuario(col_nome_completo, col_nome_usuario, col_email, col_senha)";
		$sql .= "values('$nome', '$usuario', '$email', '$senha');";

		$conn = connectDB();

		$resultado = $conn->query($sql);
		$conn->close();

		if($resultado){
			return json_encode(array('msg'=>'Usuario cadastrado com sucesso!'));
		}else{
			return json_encode(array('msg'=>'Erro ao cadastrar usuário.'));
		}

	}

	function activate($objetoDados){
		$valor = $objetoDados->ativar;
		$email = $objetoDados->email;

		$sql = "update tbl_usuario set col_ativo = $valor where col_email = $email;";

		$conn = connectDB();
		$result = $conn->query($sql);
		$conn->close();

		if($result){
			return json_encode(array('msg'=>'Operação realizada com sucesso'));
		}else{
			return json_encode(array('msg'=>'Erro ao realizar operação'));
		}

	}

	function update($objetoDados){
		$nome = $objetoDados->nome;
		$senha = $objetoDados->senha;
		$usuario = $usuario;

		$sql = "update tbl_usuario set col_nome_completo = $nome, col_senha = $senha where col_nome_usuario = $usuario;";
	
		$conn = connectDB();
		$result = $conn->query($sql);
		$conn->close();

		if($result){
			return json_encode(array('msg'=>'Dados atualizados'));
		}else{
			return json_encode(array('msg'=>'Erro ao atualizar dados'));
		}
	}


}