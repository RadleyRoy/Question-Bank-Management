<?php
	// include library
	require "vendor/autoload.php";

	// creating connection
	$conn=new MongoDB\Client("mongodb+srv://Radley:user@mycluster.doa2t.mongodb.net/questionBank?retryWrites=true&w=majority");

	   session_start();


	// creating or selection database
	$db=$conn->questionBank;

	$collection=$db->questions;

	$user = $_POST["user"];
   $_SESSION['user'] = $user;

	

	header('Location: Question Bank.php');
	

?>