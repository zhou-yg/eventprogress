<?php
session_start();
$sqlOp = include 'Objects/SqlOp.php';
$db_name = "a0711135022";

$user_id = $_SESSION["id"];
$user_name = null;
$login = FALSE;

$task_arr = null;
$msg_arr = null;

if($user_id){
	$connectResult = $sqlOp->connectTo($db_name);
	if($connectResult){
		/********************检测登录*********************/	
		$queryResult = $sqlOp->queryTo("select * from progress_users where id=$user_id");
		if($queryResult){
			$array = mysql_fetch_array($sqlOp->result);
			$user_name = $array["user_name"];
			$login = TRUE;
			//echo "<script>alert('$user_name')</script>";
		}else{
			echo "<script>alert('未找到用户')</script>";
		}	
		$sqlOp->reset();
		/*********************获取当前任务************************/	
		$queryResult = $sqlOp->queryTo("select * from progress_tasks");
		if ($queryResult) {
			$i = 0;
			while ($a = mysql_fetch_array($sqlOp->result)) {
				$task_arr[$i] = $a;
				$i++;
			}
			if($task_arr){
				for ($i=0; $i <count($task_arr) ; $i++) { 
					$ui = $task_arr[$i]["user_id"];
					$queryResult = $sqlOp->queryTo("select * from progress_users where id=$ui");
					if ($queryResult) {
						$array = mysql_fetch_array($sqlOp->result);
						$task_arr[$i]["user_name"] = $array["user_name"];
					} else {
						
					}
				}
			}else{
				
			}
		} else {

		}
		$sqlOp->reset();
		/*********************获取消息**********************/	
		$queryResult = $sqlOp->queryTo("select * from progress_msgs order by id desc");
		if($queryResult){
			$i = 0;
			while ($a = mysql_fetch_array($sqlOp->result)) {
				$msg_arr[$i] = $a;
				$i++;
			}
			if ($msg_arr) {
				for ($i=0; $i <count($msg_arr); $i++) {
					 
					$ui = $msg_arr[$i]["user_id"];
					$ti = $msg_arr[$i]["task_id"];
					
					
					$queryResult = $sqlOp->queryTo("select * from progress_users where id=$ui");
					if ($queryResult) {
						$array = mysql_fetch_array($sqlOp->result);
						$msg_arr[$i]["user_name"] = $array["user_name"];
					} else {
					}
					
					$date_arr = split("-|:| ",$msg_arr[$i]["date"]);
					$msg_arr[$i]["date_arr"] = $date_arr;
				}
			} else {
				
				
			}
		}else{
			echo "<script>alert('获取消息列表失败')</script>";
			echo "<script>location.href='../'</script>";
		}
	}else{
		
	}
}else{
	echo "<script>alert('未登录，无权限')</script>";
	echo "<script>location.href='../'</script>";
}
?>