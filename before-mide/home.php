<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>
    <h2>home</h2>
    <?php
    session_start();
    echo "hallo    ". $_SESSION['name'] ;
    echo " <br> ";

    
       
    ?>
        <a href="graph.php">graph</a> 
        <a href="logout.php">logout</a> 

</head>
<body>
    
</body>
</html>