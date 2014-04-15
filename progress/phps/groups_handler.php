<?php
$sqlOp = include 'Objects/SqlOp.php';
$db_name = "a0711135022";
session_start();

function delete_slash($string){
	$str = "";
	for ($i=0; $i < strlen($string); $i++) {
		if($string[$i] == "\\"){
		}else{
			$str = $str.$string[$i];
		}
	}
	return $str;
}

$receive = $_POST["param"];

if($receive == "myinit"){
	$user_id = $_SESSION["id"];
	$connectResult = $sqlOp->connectTo($db_name);
	if($connectResult){
		$queryResult = $sqlOp->queryTo("select * from progress_users where id=2");
		if($queryResult){
			$array = mysql_fetch_array($sqlOp->result);
			$uns_mygroups = $array["groups"];
			if ($uns_mygroups) {
				$s_mygroups = serialize($uns_mygroups);
			} else {
				echo "null";
			}
		}else{
			echo "e";
		}
	}else{
		echo "r";
	}
	
}else if($receive == "allinit"){
	echo "t";
}else{
	echo "u";
}

?>