<?php
include_once("connect.php");
if(isset($_POST['bid'])){
	$bid = $_POST['bid'];
	$sql = mysqli_query($conn,"select * from books where id='$bid' LIMIT 1");
	while($row = mysqli_fetch_assoc($sql)){
		$book_title = $row['book_title'];
		$description = $row['description'];
		$publisher = $row['publisher'];
		$author = $row['author'];
		$isbn = $row['isbn'];
		$pages = $row['pages'];
		$keyword = $row['keyword'];
	}
	echo "<form method='post' action='book_list.php'>
	<table id='edit_table'>
		<h3>Edit Details</h3>
		<tr>
			<td>Book ID :</td>
			<td><label style='margin-left:15px;'>".$bid."</label></td>
		</tr>
		<tr>
			<td>Book Title :</td>
			<td><input type='text' name='book_title' value='".$book_title."'></td>
		</tr>
		<tr>
			<td>Author :</td>
			<td><input type='text' name='author' value='".$author."'></td>
		</tr>
		<tr>
			<td>Publisher :</td>
			<td><input type='text' name='publisher' value='".$publisher."'></td>
		</tr>
		<tr>
			<td>ISBN :</td>
			<td><input type='text' name='isbn' value='".$isbn."'></td>
		</tr>
		<tr>
			<td>Pages :</td>
			<td><input type='text' name='pages' value='".$pages."'></td>
		</tr>
		<tr>
			<td>Keyword :</td>
			<td><textarea name='keyword'>".$keyword."</textarea></td>
		</tr>
		<tr>
			<td></td>
			<td><input type='submit' name='submit' value='Submit'>
                <input type='submit' name='cancel' value='Cancel' id='cancel'>
				<input type='hidden' name='bid' value='".$bid."'></td>
		</tr>
	</table>
	</form>	";
}
?>