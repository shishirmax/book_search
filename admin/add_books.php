<!-- Check user session -->

<?php
session_start();
if(isset($_SESSION['admin'])){
	$username = $_SESSION['admin'];
} else {
    header("location: ../index.php");
}
?>

<?php
include_once("connect.php");
$msg = "";
if(isset($_POST['book_title']) && isset($_FILES["file"]["name"])){
	$book_title = $_POST['book_title'];
	$description = nl2br($_POST['description']);
	$publisher = $_POST['publisher'];
	$author = $_POST['author'];
	$isbn = $_POST['isbn'];
	$pages = $_POST['pages'];
	$keyword = $_POST['keyword'];
    $len = strlen($description);
	if((!$book_title) || (!$description) || (!$publisher) || (!$author) || (!$isbn) || (!$pages) || (!$keyword)){
		$msg = "<p style='color:red;'>Please insert all details !<p>";
	}else{
		$name = $_FILES['file']['name'];
		$tmp_name = $_FILES['file']['tmp_name'];
		$size = $_FILES['file']['size'];
		 if(!empty($name)){
			$maxsize = 2097152;
			if($size > $maxsize){
				$msg = "<p style='color:red;'>File size is too large !<p>";
				unlink($tmp);
			}else {
				$newname = "jpg";
				include_once("connect.php");
				$sql=mysqli_query($conn,"insert into books(book_title,author,publisher,isbn,pages,description,keyword,date) values('$book_title','$author','$publisher','$isbn','$pages','$description','$keyword',now())");
				$id = mysqli_insert_id($conn);
				$place_file = move_uploaded_file($tmp_name,"images/$id.$newname");
				$msg = "<p style='color:green;'>Book Successfully Added to Database<p>";
                //echo $book_title."<br>".$description."<br>".$len."<br>".$publisher."<br>".$author."<br>".$isbn."<br>".$pages."<br>".$keyword ;
			}
		}
}
} else {
}

?>

<!doctype html>
<html>
    <head>
        <title>Add Books</title>
        <link rel="stylesheet" href="css/style.css" type="text/css">
    </head>
    <body>
        <div id="main_wrap">
            <header>
                <h2>Online Book Search App</h2>
            </header>
            <div id="menu">
                <ul>
                    <li><a href="add_books.php">Add Books</a></li>
                    <li><a href="book_list.php">Inventory</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
            <div id="content_wrap">
                <div class="form_content">
                    <div id="login_bar">
                        <h2>Add Books</h2>
                    </div>
                <div id="book_form">
                <form method="post" action="" class="book_submit" enctype="multipart/form-data">    
                <table class="book_add">
                    <tr>
                        <td>Book Title</td>
                        <td><input type="text" name="book_title" id="book_title"></td>
                    </tr>
                    <tr>
                        <td>Author</td>
                        <td><input type="text" name="author" id="author"></td>
                    </tr>
                    <tr>
                        <td>Publisher</td>
                        <td><input type="text" name="publisher" id="publisher"></td>
                    </tr>
                    <tr>
                        <td>ISBN</td>
                        <td><input type="text" name="isbn" id="isbn"></td>
                    </tr>
                    <tr>
                        <td>Pages</td>
                        <td><input type="text" name="pages" id="pages"></td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td><textarea name="description" id="description"></textarea></td>
                    </tr>
                    <tr>
                        <td>Keywords</td>
                        <td><textarea name="keyword" id="keyword"></textarea></td>
                    </tr>
                    <tr>
						<td>Upload Picture</td>
						<td><input type="file" name="file" id="file" ></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" name="submit" value="Add To Database"></td>
					</tr>
                    <tr>
						<td></td>
						<td><?php echo $msg; ?></td>
					</tr>
                </table>
                </form>
                </div>
                </div>
            </div>
        </div>
    </body>
</html>