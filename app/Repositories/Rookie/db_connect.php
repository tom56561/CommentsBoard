<?php
	//PHP 及 MySQL 範例資料庫連線語法。
	
	//連線至資料庫
	
	$hostname="rookie-mysql";
	$username="root";
	$password="asd123";
	$dbname="db_test01";
	$usertable="user";
	
	mysqli_connect($hostname,$username, $password) or die ("html>script language='JavaScript'>alert('無法連線至資料庫！請稍後再重試一次。'),history.go(-1)/script>/html>");
	mysqli_select_db($dbname);
	
	# 查看記錄是否存在
	
	$query = "SELECT * FROM $usertable";
	
	$result = mysqli_query($query);
	
	if($result){
		while($row = mysqli_fetch_array($result)){
			$name = $row[0];
			echo "Name: ".$name."br/>";
		}
	}
?>