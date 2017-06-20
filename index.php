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
				<h2>Recent Books Added</h2>
				<hr>
				<br>
				<?php
				include_once("connect.php");
				$sql = mysqli_query($conn,"select * from books order by date desc");
				$count = mysqli_num_rows($sql);
				$img = "";
				if($count>0){
					while($row = mysqli_fetch_assoc($sql)){
						$id = $row['id'];
						$book_title = $row['book_title'];
                        $description = $row['description'];
                        $des = substr($description, 0, 300);
                        $author = $row['author'];
						$img = "<img src='admin/images/".$id.".jpg' width='150px' height='190px' class='fadeto'>";
						?>
						<div id="product">
                            <div id="image">
                                <a href="view.php?id=<?php echo $id ; ?>"><?php echo $img; ?></a>
                            </div>
                            <div id="details">
                                <h3><?php echo $book_title; ?></h3><hr>
                                <p><h4>By <?php echo $author; ?></h4> </p>
                                <br>
                                <p><?php echo $des; ?>... <a href="view.php?id=<?php echo $id ; ?>">View More</a> </p>
                            </div>
						
						</div>
						
				<?php
					}
				}
				?>
				
				
			</div>
            </div>
        </div>
    </body>
</html>