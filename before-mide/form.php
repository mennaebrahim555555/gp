<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    session_start();
?>
 
<form method="POST" action="contact.php">
    <?php
        $_token = md5(time());
        $_SESSION["_token"] = $_token;
    ?>
    <input type="hidden" name="_token" value="<?php echo $_token; ?>" />
 
    <p>
       
        <input type="text" name="name"placeholder="Name" required>
    </p>
 
    <p>
        
        <input type="email" name="email" placeholder="Email" required>
    </p>
 
    <p>
       
        <textarea name="message" placeholder="Message"></textarea>
    </p>
 
    <p>
        <input type="submit" name="contact_us" value="Send message">
    </p>
</form>
</body>
</html>