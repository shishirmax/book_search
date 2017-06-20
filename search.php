<?php
include_once("connect.php");
$output = "";
if(isset($_GET['search'])){
	$search = $_GET['search'];
	//$search = preg_replace("#[^0-9a-z]#i", "", $search);
	$query = mysqli_query($conn,"select * from books where book_title LIKE '%$search%'");
	$count = mysqli_num_rows($query);
	if($count == 0){
		$output = "No Products Found.";
	} else {
		while($row = mysqli_fetch_assoc($query)){
			$id = $row['id'];
			$book_title = $row['book_title'];
			$author = $row['author'];
            $description = $row['description'];
            $des = substr($description, 0, 300);
			$img = "<img src='admin/images/".$id.".jpg' width='150px' height='190px' class='fadeto'>";

			$output .= '<div id="product">';
            $output .= '<div id="image">';
			$output .= '<a href="view.php?id='. $id .'">'. $img .'</a><br/>';
            $output .= '</div>';
            $output .= '<div id="details">';
			$output .= '<h4>'. $book_title .'</h4><hr>';
			$output .= '<h4>'. $author .'</h4>';
			$output .= '<p>'. $des .'...<a href="view.php?id='. $id .'">View More</a></p>';
            $output .= '</div>';
			$output .= '</div>';
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
				<h2>Search Results</h2>
				<hr>
				<br>
				<?php
				    echo $output;
				?>
				
				
			</div>
            </div>
        </div>
    </body>
</html>