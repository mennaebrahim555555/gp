<?php
    session_start();
 
    // check if the form submits
    if (isset($_POST["contact_us"]))
    {
        $_token = $_POST["_token"];
 
        // check CSRF token
        if (isset($_SESSION["_token"]) && $_SESSION["_token"] == $_token)
        {
            // remove the token so it cannot be used again
            unset($_SESSION["_token"]);
 
            // connect with database
            $conn = mysqli_connect("localhost", "root", "", "testt");
 
            // get and validate input fields from SQL injection
            $name = mysqli_real_escape_string($conn, $_POST["name"]);
            $email = mysqli_real_escape_string($conn, $_POST["email"]);
            $message = mysqli_real_escape_string($conn, $_POST["message"]);
            $is_read = 0;
 
            // sending email
            $headers = 'From: YourWebsite <admin@yourwebsite.com>' . "\r\n";
            $headers .= 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
             
            $to = "care17782@gmail.com";
            $subject = "New Message";
 
            $body = "<h1>Message from:</h1>";
            $body .= "<p>Name: " . $name . "</p>";
            $body .= "<p>Email: " . $email . "</p>";
            $body .= "<p>Message: " . $message . "</p>";
 
            mail($to, $subject, $body, $headers);
 
            // saving in database
            $sql = "INSERT INTO inbox(name, email, message, is_read, created_at) VALUES ('" . $name . "', '" . $email . "', '" . $message . "', " . $is_read . ", NOW())";
            mysqli_query($conn, $sql);
 
            echo "<p>Your message has been received. Thank you.</p>";
        }
        else
        {
            echo "<p>Something went wrong.</p>";
        }
 
        header("refresh: 5; url=contact.php");
    }
?>

<?php
    // connect with database
    $conn = mysqli_connect("localhost", "root", "", "testt");
 
    // get all inbox messages such that latest messages are on top
    $sql = "SELECT * FROM inbox ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);
 
?>
 
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
        }
    </style>
 
    <table class="table">
 
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Message</th>
            <th>Actions</th>
        </tr>
 
