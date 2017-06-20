<?php
if(isset($_POST['bid'])) {
    $bid = $_POST['bid'];
    echo "<h3>Are You Sure you want to Delete?</h3>
            <form method='post' action='book_list.php'>
                <input type='submit' name='delete' value='Delete'>
                <input type='submit' name='cancel' value='Cancel'>
                <input type='hidden' name='bid' value='". $bid ."'>
            </form>";
}
?>