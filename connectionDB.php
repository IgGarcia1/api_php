<?php


function connectDB(){
	$servername = "localhost";
	$username = "root";
	$pass = '';
	$dbname = 'apiPhp';

	$conn = new mysqli($servername, $username, $pass, $dbname) or die("Connection failed!");

	return $conn;
}