<?php
	session_start();
	include("assets/connect.php");
	
	if(!isset($_SESSION['token'])||!isset($_SESSION['usrid'])||!isset($_SESSION['name'])){
        exit('illegal access!');
	}else{
		$user_id=$_SESSION['usrid'];
	}
	
	$id=$_POST["id"];
	try {
		
		$query = $DBH->prepare("delete from borrow_info where pk_id = ? ");
		$query->bindParam(1,$id);
		$query->execute();	
	}
	catch(PDOException $e){
		die($e->getMessage());
	}

?>