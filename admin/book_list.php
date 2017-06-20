<!-- Check User Session -->

<?php
session_start();
if(isset($_SESSION['admin'])){
	$username = $_SESSION['admin'];
} else {
    header("location: ../index.php");
}
?>

<!--For Display of Book Lists -->

<?php
include_once("connect.php");
$inventory = "";
$sql = mysqli_query($conn,"select * from books");
while($row = mysqli_fetch_assoc($sql)){
	$id = $row['id'];
	$book_title = $row['book_title'];
	$date = $row['date'];
	$inventory .= "<tr>";
	$inventory .= "<td>". $id ."</td>";
	$inventory .= "<td>". $book_title ."</td>";
	$inventory .= "<td>". $date ."</td>";
	$inventory .= "<td><p id='". $id ."' class='edit'>Edit</p></td>";
	$inventory .= "<td><center><p class='delete' id='". $id ."'>Delete</p></center></td>";
	$inventory .= "</tr>";
}
?>

<!-- For Editing -->

<?php
if(isset($_POST['submit'])){
	$bid = $_POST['bid'];
	$book_title = $_POST['book_title'];
	//$description = $_POST['description'];
	$publisher = $_POST['publisher'];
	$author = $_POST['author'];
	$isbn = $_POST['isbn'];
	$pages = $_POST['pages'];
	$keyword = $_POST['keyword'];
    include_once("connect.php");
	//echo $bid." ".$book_title."  ".$publisher." ".$author;
	mysqli_query($conn,"update books set book_title='$book_title', publisher='$publisher', author='$author', isbn='$isbn', pages='$pages', keyword='$keyword' where id='$bid'");
	header("location: book_list.php");
}
?>

<!-- For Deleting -->

<?php
if(isset($_POST['delete'])){
    $bid = $_POST['bid'];
    $file = "images/$bid.jpg";
    include_once("connect.php");
    mysqli_query($conn,"delete from books where id='$bid'");
    unlink($file);
    header("location: book_list.php");
}
?>


<!doctype html>
<html>
    <head>
        <title>Add Books</title>
        <script type="text/javascript" src="js/jquery-1.10.2.js"></script>
        <link rel="stylesheet" href="css/style.css" type="text/css">
    </head>
    <body>
        <div id="overlay"></div>
        <div id="frame"></div>
        <div id="confirm_box"></div>
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
                <div class="list_content">
                    <div id="login_bar">
                        <h2>Book List</h2>
                    </div>
                <div id="book_list">
                    <table class="book_add">
                        <tr class="head">
                            <td>ID</td>
                            <td>Book Title</td>
                            <td>Date Added</td>
                            <td>Edit</td>
                            <td>Delete</td>
                        </tr>
                        <?php echo $inventory; ?>
                    </table>
                </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="js/script.js"></script>
    </body>
</html>