<?php

session_start();

session_destroy(); //destroy session

if(!isset($_SESSION['username'])){
	header("location: index.php");
	}else{
		echo "<h2>Sorry,Logout Error Occurs!</h2>";
}
?>