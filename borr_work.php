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
	$name=$_POST['name'];
	$contact=$_POST['contact'];
	$reason=$_POST['reason'];
<<<<<<< HEAD
		try{
=======
<<<<<<< HEAD
		try{
=======
	try{
>>>>>>> origin/master
>>>>>>> origin/master
		$sql=$DBH->prepare("select count(*) as num from borrow_info where borrow_id = ? and date > ? ");
		date_default_timezone_set('Asia/Shanghai');
		$nowDate = date("Y-m-d");
		$sql->bindParam(1,$user_id);
		$sql->bindParam(2,$nowDate);
		$sql->execute();
		$result = $sql->fetch();
		//print_r($sql->errorInfo());
	}catch(PDOException $e){
			die($e->getMessage());
	}
	if($result['num']>0){//已经预约过一个了
		echo '-1';
<<<<<<< HEAD
	}else{try {
=======
<<<<<<< HEAD
	}else{try {
=======
	}else{
		try {
>>>>>>> origin/master
>>>>>>> origin/master
		$sql = $DBH->prepare("select count(*) as num from borrow_info where site_id = ? and date = ? and period = ? ");
		$sql->bindParam(1,$sid);
		$sql->bindParam(2,$bdate);
		$sql->bindParam(3,$bpd);
		$sql->execute();
		$result = $sql->fetch();
		print($result['num']);
<<<<<<< HEAD
		/*插入前验证一下是否已经被预约，以防两人同时预约先后问题*/
=======
<<<<<<< HEAD
		/*插入前验证一下是否已经被预约，以防两人同时预约先后问题*/
=======
		/*验证是否已经被预约该场地，以防两人同时预约先后问题*/
>>>>>>> origin/master
>>>>>>> origin/master
		if ($result['num']==0){
		$query = $DBH->prepare("insert into borrow_info (site_id,date,period,borrow_id,name,contact,reason) values (?,?,?,?,?,?,?) ");
		$query->bindParam(1,$sid);
		$query->bindParam(2,$bdate);
		$query->bindParam(3,$bpd);
		$query->bindParam(4,$user_id);
		$query->bindParam(5,$name);
		$query->bindParam(6,$contact);
		$query->bindParam(7,$reason);
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> origin/master
		$query->execute();	
		//	print_r($query->errorInfo());
	    }	
	    }
<<<<<<< HEAD
=======
=======
		$query->execute();
		//print_r($query->errorInfo());		
		}
		}
>>>>>>> origin/master
>>>>>>> origin/master
		
		catch(PDOException $e){
			die($e->getMessage());
		}
	}

?>