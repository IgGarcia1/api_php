<?php

require('../connectionDB.php');

/*header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
*/

class UserDAO{
	
	function create($objetoDados){

		$nome = $objetoDados["nome"];
		$usuario = $objetoDados["usuario"];
		$email = $objetoDados["email"];
		$senha = md5($objetoDados["senha"]);

		$sql = "insert into tbl_usuario(col_nome, col_usuario, col_email, col_senha)";
		$sql .= "values('$nome', '$usuario', '$email', '$senha');";

		$conn = connectDB();

		$resultado = $conn->query($sql);
		$erro = $conn->error;
		$conn->close();
		
		if($resultado){
			return json_encode(array('msg'=>'Usuario cadastrado com sucesso!'));
		}else{
			return json_encode(array('msg'=>'Error. Erro ao cadastrar usuário.' . $erro));
		}

	}

	function activate($objetoDados){
		$valor = $objetoDados["ativar"];
		$email = $objetoDados["email"];
		//echo $email . "   " . $valor;

		$sql = "update tbl_usuario set col_ativo = $valor where col_email = '$email';";

		$conn = connectDB();
		$result = $conn->query($sql);
		$error = $conn->error;
		//$conn->close();
		if(!$this->verifica_ha_dados($email)){
			return json_encode(array('msg'=>'Error. Usuário não encontrado'));
		}

		if(mysqli_query($conn, $sql)){//$result === TRUE){
			return json_encode(array('msg'=>'Usuário ativado com sucesso'));
		}else{
			return json_encode(array('msg'=>'Error. Erro ao ativar usuário. '. $error));
		}

	}

	function verifica_ha_dados($email = '', $user = ''){
		$sql = "select * from tbl_usuario where col_email = '$email' or col_usuario='$user';";
		$conn = connectDB();
		$result = $conn->query($sql);
		if ($result->num_rows == 1){
			$retorno = 1;
		}else{
			$retorno = 0;
		}
		$conn->close();
		return $retorno;
	}


	function get_user($dados){
		if(isset($dados["email"])){
			$email = $dados["email"];
		}else{
			$email = '';
		} 
		if(isset($dados["usuario"])) {
			$user = $dados["usuario"];
		}else{
			$user='';
		}
		
		$sql = "select col_nome, col_usuario, col_email, col_ativo from tbl_usuario where col_email = '$email' or col_usuario='$user';";
		$conn = connectDB();
		$result = $conn->query($sql);
		
		if ($result->num_rows == 1){
			$conn->close();
			$row = $result->fetch_assoc();
			return json_encode($row);
		}else{
			$conn->close();
			return json_encode(array('msg'=>"Error. Usuário não cadastrado"));
		}
	}

	function update($objetoDados){
		$nome = $objetoDados["nome"];
		$usuario = "";
		if(isset($objetoDados["usuario"])){
			$usuario = $objetoDados["usuario"];
		}
		$email = "";
		if(isset($objetoDados["email"])){
			$email = $objetoDados["email"];
		}

		$sql = "update tbl_usuario set col_nome = '$nome' where col_usuario = '$usuario' or col_email = '$email';";
	
		if(!$this->verifica_ha_dados($email, $usuario)){
			return json_encode(array('msg'=>'Error. Usuário não encontrado'));
		}

		$conn = connectDB();
		$result = $conn->query($sql);
		$conn->close();

		if($result){
			return json_encode(array('msg'=>'Dados atualizados'));
		}else{
			return json_encode(array('msg'=>'Error. Erro ao atualizar dados'));
		}
	}

	function update_password(){}
}