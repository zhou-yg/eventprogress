<?php
session_start();
$sqlOp = include 'Objects/SqlOp.php';
$db_name = "a0711135022";
$user_id = $_SESSION["id"];
$user_name = null;
$login = FALSE;

if($user_id){
	$connectResult = $sqlOp->connectTo($db_name);
	if($connectResult){
		/********************登录名*********************/	
		$queryResult = $sqlOp->queryTo("select * from progress_users where id=$user_id");
		if($queryResult){
			$array = mysql_fetch_array($sqlOp->result);
			$user_name = $array["user_name"];
			$login = TRUE;
			//echo "<script>alert('$user_name')</script>";
		}else{
			echo "<script>alert('未找到用户')</script>";
		}	
		/*******************************************/
		$task_name = $_POST["target_obj"];
		$queryResult = $sqlOp->queryTo("insert into progress_tasks values(NULL,'$task_name','$user_id')");
		if ($queryResult) {
			echo "<script>location.href='../progress_list.php'</script>";
		} else {
			echo "failed";
		}
	}else{
		
	}	
}else{
	echo "<script>alert('未登录，无权限')</script>";
	echo "<script>location.href='../'</script>";
}
?>