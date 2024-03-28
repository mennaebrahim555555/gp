<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
</head>
<body>
<h1>register</h1>
<?php

//Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
 
    //Load Composer's autoloader
    require 'vendor/autoload.php';

    if (isset($_POST["register"]))
    {
 
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
 //////////////
 $conn = mysqli_connect("localhost", "root", "", "testt");

    // check if credentials are okay, and email is verified
    $sql = "SELECT * FROM users WHERE email = '" . $email . "'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1)
    {
        echo "<script>alert('This email is already registered');</script>";
    //    die("Email not found.");
    }
else{



        //Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);
 
        try {
            //Enable verbose debug output
            $mail->SMTPDebug = 0;//SMTP::DEBUG_SERVER;
 
            //Send using SMTP
            $mail->isSMTP();
 
            //Set the SMTP server to send through
            $mail->Host = 'smtp.gmail.com';
 
            //Enable SMTP authentication
            $mail->SMTPAuth = true;
 
            //SMTP username
            $mail->Username = 'care17782@gmail.com';
 
            //SMTP password
            $mail->Password = 'xknw xcbt xzox pvpp';
 
            //Enable TLS encryption;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
 
            //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            $mail->Port = 587;
 
            //Recipients
            $mail->setFrom('care17782@gmail.com', 'care');
 
            //Add a recipient
            $mail->addAddress($email, $name);
 
            //Set email format to HTML
            $mail->isHTML(true);
 
            $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
 
            $mail->Subject = 'Email verification';
            $mail->Body    = '<p>Your verification code is: <b style="font-size: 30px;">' . $verification_code . '</b></p>';
 
            $mail->send();
            // echo 'Message has been sent';
 
         //  $encrypted_password = password_hash($password, PASSWORD_DEFAULT);
 
            // connect with database
            $conn = mysqli_connect("localhost", "root", "", "testt");
 
            // insert in users table
      //  $sql = "INSERT INTO users(username, email, password,verfiycode, time) VALUES ('" . $name . "', '" . $email . "', '" . $encrypted_password . "', '" . $verification_code . "',0)";

    $sql="INSERT INTO `verificationcode` ( `email`, `verification code`, `time`) VALUES ( '$email', ' $verification_code', '0')";
      mysqli_query($conn, $sql);

            header("Location: verification.php?email=" . $email);
            exit();
        } catch (Exception $e) {
           // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
          echo "<script>alert('Please enter a valid email');</script>";

            
        }
    }
}
?>
<form method="POST">
    <input type="text" name="name" placeholder="Enter name" required /></br>
    <input type="text" name="phonenum" placeholder="Enter phone number" required /></br>
    <input type="email" name="email" placeholder="Enter email" required /></br>
    <input type="password" name="password" placeholder="Enter password" required /></br></br>

    <input type="submit" name="register" value="Register"></br>
    <a href="login.php">log in</a> </br>
    <a href="form.php">contact us</a> </br>
</form>
 

<?php
if (isset($_POST["register"]))
{ session_start();
$_SESSION['name']="";
$_SESSION['phonenum']="";
$_SESSION['email']="";
$_SESSION['password']="";
$_SESSION['passwordinc']="";


    $name = $_POST["name"];
    $phonenum = $_POST["phonenum"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $encrypted_password = password_hash($password, PASSWORD_DEFAULT);


$_SESSION['name']=$name;
$_SESSION['email']=$email;
$_SESSION['phonenum']=$phonenum;
$_SESSION['password']= $password;
$_SESSION['passwordinc']="$encrypted_password";
}

    

?>
</body>
</html>
