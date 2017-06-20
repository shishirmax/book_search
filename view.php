<?php
include_once("connect.php");
if(isset($_GET['id'])){
    $bid = $_GET['id'];
    $sql = mysqli_query($conn,"select * from books where id='$bid' LIMIT 1");
    $count = mysqli_num_rows($sql);
    if($count > 0) {
        while($row = mysqli_fetch_assoc($sql)) {
            $book_title = $row['book_title'];
		    $description = $row['description'];
		    $publisher = $row['publisher'];
		    $author = $row['author'];
		    $isbn = $row['isbn'];
		    $pages = $row['pages'];
            $img = "<img src='admin/images/".$bid.".jpg' class='fadeto'>";
        }
    }
}
?>

<!doctype html>
<html>
    <head>
        <title>Book Search App</title>
        <link rel="stylesheet" href="css/style.css" type="text/css">
    </head>
    <body>
        <div id="main_wrap">
            <header>
                <h2>Online Book Search App</h2>
            </header>
            <div id="menu">
                <ul>
                    <li><a href="index.php">Home</a></li>
                </ul>
                <div id="search_form">
                <form method="get" action="search.php">
                    <input type="text" name="search" placeholder="Search a book">
                    <input type="submit" name="search_button" value="Search">
                </form>
                </div>
            </div>
            <div id="content_wrap">
                <div id="main-content">
				    <br>
                    <div id="left">
                        <?php echo $img; ?>
                    </div>
                    <div id="right">
                        <h2><?php echo $book_title; ?></h2>
                        <hr>
                        <h3>By <?php echo $author; ?></h3>
                        <br>
                        <h4>Publisher: <?php echo $publisher; ?></h4>
                        <br>
                        <p><?php echo $description; ?></p>
                        <br>
                        <h4>ISBN : <?php echo $isbn; ?></h4>
                        <br>
                        <h4>Pages : <?php echo $pages; ?></h4>
                    </div>
                    <div id="footer"></div>
			    </div>
            </div>
            
        </div>
    </body>
</html>