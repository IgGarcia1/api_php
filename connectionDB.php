<?php


function connectDB(){
	$servername = "localhost";
	$username = "root";
	$pass = '';

	$conn = new mysqli($servername, $username, $pass) or die("Connection failed!");

	return $conn;
}