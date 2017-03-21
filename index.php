<?php
	/*对未来beginDay后showingDay天的日期赋值给全局变量*/
	function show_valid_days($beginDay,$showingDay) {
		global $date,$date_id;
		date_default_timezone_set('Asia/Shanghai');
		$nowTimeShow = date("Y年m月d日 H:i");
		$nowTime = date("H:i");
		$nowDate = date("Y-m月d日");
		$flag = 0;
		if ($nowTime >= "17:00")
		{
			$flag = 1;
		}
		else
		{
			;
		}
		for ($i=0;$i<$showingDay;$i++)
		{
			$date[$i] = date("m月d日",strtotime("+".($i+$flag+$beginDay)." day"));
			$date_id[$i] = date("Ymd",strtotime("+".($i+$flag+$beginDay)." day"));
		}
	}
	
	function get_sites() {
		global $site_id,$site_name,$DBH;
		try {
			$query = $DBH->prepare("select * from site_info");
			$query->execute();
			$results = $query->fetchAll(PDO::FETCH_ASSOC);
			//print_r($query->errorInfo());
			$i = 0;
			foreach($results as $result) {
				$site_id[$i] = $result['site_id'];
				$site_name[$i] = $result['name'];
				$i++;
			}
			return $i;
		}
		catch(PDOException $e){
			die($e->getMessage());
		}
	
	}
?>
<meta charset="UTF-8">
<?php
	session_start();
	
	$_SESSION['token']='123';
	$_SESSION['usrid']='988793';
	$_SESSION['name']='Atlas';
	/*验证易班的session*/
	if(!isset($_SESSION['token'])||!isset($_SESSION['usrid'])||!isset($_SESSION['name'])){
        exit('illegal access!');
	}else{
		$user_id=$_SESSION['usrid'];
	}
    include "assets/db_config.php";
    include "assets/connect.php";

    $date = array();
    $date_id = array();
	$site_id = array();
	$site_name = array();
	
	show_valid_days(5,5);
	$sites_n = get_sites();
	
	for($j=0;$j<$sites_n;$j++) {
		?>
		<div><?=$site_name[$j]?></div>
		<?php
			$index = 0;
			foreach($date as $eachdate) {
			?>
			<!--TODO:增加样式-->
			<div>
			<?=$eachdate?>
			</div>
			<!--end-->
			<?php 
				for($i=0;$i<4;$i++){
					?>
					<div><?=9+2*$i?>点~<?=11+2*$i?>点</div>
					<?php
						try{
							$query = $DBH->prepare("select count(*),borrow_id from borrow_info where site_id=? and date=? and period = ?");
							$query->bindParam(1,$site_id[$j]);
							$query->bindParam(2,$date_id[$index]);
							$query->bindParam(3,$i);
							$query->execute();
							$result=$query->fetch();
							$ifborred=$result['count(*)'];
						
						}catch(PDOException $e){
							die($e->getMessage());
						}
						if($ifborred == 0){
					?>
					<button id="s<?=$site_id[$j]?>-d<?=$date_id[$index]?>-p<?=$i?>" class="borr-qry">预约</button>
					<?php
						}else{
							?>
							<button id="s<?=$site_id[$j]?>-d<?=$date_id[$index]?>-p<?=$i?>" class="borr-qry" disabled="disabled">已预约</button>
							
							<?php
							/*TODO:根据usrid判断是否是我的预约，如果是我的预约则有取消选项，具体几个按钮和前端商量*/
							if($result['borrow_id']==$user_id){
								echo "cancel";
							}
						}
						?>
					<?php
				}
			?>
			<?php
				$index++;
			}
			?>
		
		<?php
	}
	
?>
<script src="js/jquery-3.2.0.min.js"></script>
<script src="js/index.js"></script>