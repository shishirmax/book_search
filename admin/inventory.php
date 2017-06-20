<?php
include_once("../connect.php");
$inventory = "";
$sql = mysql_query("select * from products");
while($row = mysql_fetch_array($sql)){
	$id = $row['id'];
	$p_name = $row['p_name'];
	$price = $row['price'];
	$status = $row['status'];
	$inventory .= "<tr>";
	$inventory .= "<td>". $id ."</td>";
	$inventory .= "<td>". $p_name ."</td>";
	$inventory .= "<td>". $price ."</td>";
	$inventory .= "<td>". $status ."</td>";
	$inventory .= "<td><p id='". $id ."' class='edit'>Edit</p></td>";
	$inventory .= "<td><center><p class='delete' id='". $id ."'>Delete</p></center><span class='". $id ."' style='display:none;'>Sure?<input type='submit' name='delete' value='Delete'></span></td>";
	$inventory .= "</tr>";
}
?>

<?php
$status = "1";
if(isset($_POST['submit'])){
	$pid = $_POST['pid'];
	$p_name = $_POST['p_name'];
	$price = $_POST['price'];
	$detail = $_POST['detail'];
	$status = $_POST['status'];
	$publisher = $_POST['publisher'];
	$author = $_POST['author'];
	$isbn = $_POST['isbn'];
	$pages = $_POST['pages'];
	$publication_year = $_POST['publication_year'];
	//echo $pid." ".$p_name." ".$price." ".$status." ".$publisher." ".$author;
	mysql_query("update products set p_name='$p_name', price='$price', detail='$detail', status='$status', publisher='$publisher', author='$author', isbn='$isbn', pages='$pages', publication_year='$publication_year' where id='$pid'");
	header("location: inventory.php");
}
?>

<html>
<head>
	<title>Inventory</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/style2.css">
	<script type="text/javascript" src="../js/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="../js/jquery-ui-1.10.3.custom.min.js"></script>
</head>
<body>
	<div id="overlay2">
	</div>
	<?php include_once("tmp/header.php"); ?>
	<div id="frame">
	</div>
	
	
	<div id="wrapper">
		<div id="main">
			<h3>Inventory List</h3>
			<table id="order_table" width="800px">
				<tr class="head">
					<td>ID</td>
					<td>Product Name</td>
					<td>Price</td>
					<td>Status</td>
					<td>Edit</td>
					<td>Delete</td>
				</tr>
				<?php echo $inventory; ?>
			</table>
			
		</div>
	</div>

	<script type="text/javascript">
	$(".edit").click(function(){
		var pid = $(this).attr('id');
		$.post("inventory_edit.php",{pid:pid},function(data){
			console.log(data);
			$("#frame").fadeIn();
			$("#frame").html(data);
			$("#overlay2").fadeIn();
		});
	});

	$("#overlay2").click(function(){
		$(this).fadeOut();
		$("#frame").fadeOut();
	})

	$(".delete").click(function(){
		var cls = $(this).attr('id')
		$(this).fadeOut();
		$("." + cls).fadeIn();
	});
	</script>


</body>
</html>