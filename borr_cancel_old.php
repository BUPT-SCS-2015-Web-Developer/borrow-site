<?php
	session_start();
	include("assets/connect.php");
	
	if(!isset($_SESSION['token'])||!isset($_SESSION['usrid'])||!isset($_SESSION['name'])){
        exit('illegal access!');
	}else{
		$user_id=$_SESSION['usrid'];
	}
	
	$sid = $_POST['site_id'];
	$bdate = $_POST['borr_date'];
	$bpd = $_POST['borr_period'];
	try {
		
		$query = $DBH->prepare("delete from borrow_info where site_id = ? and date = ? and period = ? ");
		$query->bindParam(1,$sid);
		$query->bindParam(2,$bdate);
		$query->bindParam(3,$bpd);
		$query->execute();	

	}
	catch(PDOException $e){
		die($e->getMessage());
	}

?>