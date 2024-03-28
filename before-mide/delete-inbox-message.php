<?php
    // connect with database
    $conn = mysqli_connect("localhost", "root", "", "testt");
  
    // prevent from SQL injection
    $id = mysqli_real_escape_string($conn, $_POST["id"]);
     
    // delete the message
    $sql = "DELETE FROM inbox WHERE id = " . $id;
    mysqli_query($conn, $sql);
 
    // display a success message
    echo "<p>Message has been deleted.</p>";
?>