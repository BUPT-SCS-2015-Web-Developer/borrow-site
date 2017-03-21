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
		/*TODO:插入前验证一下是否已经被预约，以防两人同时预约先后问题*/
		$query = $DBH->prepare("insert into borrow_info (site_id,date,period,borrow_id) values (?,?,?,?) ");
		$query->bindParam(1,$sid);
		$query->bindParam(2,$bdate);
		$query->bindParam(3,$bpd);
		$query->bindParam(4,$user_id);
		$query->execute();	
		//	print_r($query->errorInfo());
	}
	catch(PDOException $e){
		die($e->getMessage());
	}

?>