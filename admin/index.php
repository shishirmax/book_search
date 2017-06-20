<?php
session_start();
if(isset($_SESSION['admin'])){
	$username = $_SESSION['admin'];
    header("location: add_books.php");
}
?>

<?php
include_once("connect.php");
$err = "";
if(isset($_POST['admin_login'])){
	$login = $_POST['admin_login'];
	$pass = $_POST['password'];
    $pass = md5($pass);
	if((!$login) || (!$pass)){
		$err = "Incorrect Details";
	}else {
		$sql = mysqli_query($conn, "select * from admin where admin='$login'");
		$count = mysqli_num_rows($sql);
		if($count>0){
			while($row = mysqli_fetch_assoc($sql)){
				$id = $row['id'];
                $pwd = $row['password'];
                if($pass == $pwd) {
                    $login = $row['admin'];
                    $_SESSION['id'] = $id;
                    $_SESSION['admin'] = $login;
			        header("location: add_books.php");
                } else {
                    $err = "<div id='status'><strong>Oh Snap! </strong>Incorrect Details.</div>";
                }
			}
		}else {
			$err = "<div id='status'><strong>Oh Snap! </strong>Incorrect Details.</div>";
		}
	}
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Book Search</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <div id="main_wrap">
        <header>
                <h2>Online Book Search App</h2>
        </header>
        <div id="content_wrap">
            <div id="content">
                <div id="login_bar">
                    <h2>Admin Login</h2>
                </div>
                <div id="login_form">
                    <form method="post" class="form_submit">
                        <table>
                            <tr>
                                <td>Login ID :</td>
                                <td><input type="text" name="admin_login" id="admin_login"></td>
                            </tr>
                            <tr>
                                <td>Password :</td>
                                <td><input type="password" name="password" id="password"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input type="submit" name="submit" value="Login" class="submit"></td>
                            </tr>
                        </table>
                    </form>
                    <div id="result"><?php echo $err; ?></div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="js/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
</body>
</html>
