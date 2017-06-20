<?php
session_start();
include_once("connect.php");
$err = "";
if(isset($_POST['admin_login'])){
	$login = $_POST['admin_login'];
	$pass = $_POST['password'];
    $pass = md5($pass);
	if((!$login) || (!$pass)){
		$err = "Incorrect Details";
	}else {
		$sql = mysql_query("select * from admin where admin='$login' and pass='$pass' limit 1");
		$count = mysql_num_rows($sql);
		if($count>0){
			while($row = mysql_fetch_array($sql)){
				$id = $row['id'];
				$login = $row['login'];
				$_SESSION['id'] = $id;
				$_SESSION['login'] = $login;
			}
			header("location: add_books.php");
		}else {
			$err = "Incorrect Details";
		}
	}
}
?>