<?php
    // connect with database
    $conn = mysqli_connect("localhost", "root", "", "testt");
 
    // prevent from SQL injection
    $id = mysqli_real_escape_string($conn, $_POST["id"]);
     
    // set the message as read
    $sql = "UPDATE inbox SET is_read = 1 WHERE id = " . $id;
    mysqli_query($conn, $sql);
 
    // display a success message
    echo "<p>Message has been marked as read.</p>";
?>