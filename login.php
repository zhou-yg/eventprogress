<?php
session_start();

$school_number = $_POST["schoolNumber"];

$sqlOp = include 'progress/phps/Objects/SqlOp.php';

$connectResult = $sqlOp -> connectTo("a0711135022");
if ($connectResult) {
	$queryResult = $sqlOp -> queryTo("select * from progress_users");
	if ($queryResult) {
		$result = $sqlOp -> result;
		$user_id = null;
		while ($array = mysql_fetch_array($result)) {
			if ($school_number == $array["school_number"]) {
				$user_id = $array["id"];
				break;
			}
		}
		if ($user_id) {
			$_SESSION["id"] = $user_id;
			echo "<script>location.href='progress/progress_list.php?id=$user_id'</script>";
		} else {
			echo "<script>alert('登录失败')</script>";
			echo "<script>location.href='/'</script>";
		}
	} else {
		echo "<script>alert('query failed')</script>";
		echo "<script>location.href='/'</script>";
	}
} else {
	echo "<script>alert('connect failed')</script>";
	echo "<script>location.href='/'</script>";
}

/*
 $connect = mysql_connect("localhost:3306","root","123456");
 //mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8'");
 if ($connect) {
 mysql_set_charset("utf8",$connect);  //统一服务端与客户端的字符集合
 $my_db = mysql_select_db("a0711135022",$connect);
 if($my_db){
 $sqlStr = "select * from progress_users";
 $result = mysql_query($sqlStr,$connect);
 if($result!=FALSE){
 $user_id = null;
 while($array = mysql_fetch_array($result)){
 if($school_number == $array["school_number"]){
 $user_id = $array["user_id"];
 break;
 }
 }
 if($user_id){
 $_SESSION["user_id"] = $user_id;
 echo "<script>location.href='../progress_list.php?id=$user_id'</script>";
 }else{
 echo "<script>alert('登录失败')</script>";
 echo "<script>location.href='../../'</script>";
 }
 }else{
 echo "query failed";
 }
 }else{
 echo "select failed";
 }
 }else{
 echo "connect failed";
 }
 mysql_close($connect);
 * *
 */
 ?>
