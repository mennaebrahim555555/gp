<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="style.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="login">  
    <h1>forgt password</h1>
    <form method="post" action="">
    <input type="text" name="email" id=""placeholder="email"require> <br><br>
    
    <input type="text" name=" password" id=""placeholder="New Password"require> <br><br>
    <input type="submit" value="submit" name="submit"> <br><br>
    </form>
    </div>

<?php
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\SMTP;
 use PHPMailer\PHPMailer\Exception;

 //Load Composer's autoloader
 require 'vendor/autoload.php';





if(isset($_POST['submit'])){
  $password=$_POST['password'];
  $email=$_POST['email'];
  session_start();
  $_SESSION['password']="";
  
  $_SESSION['password']= $password;


  $conn = mysqli_connect("localhost", "root", "", "testt");

  $stm="select * from users where  email='$email'";
$result=mysqli_query($conn,$stm);
$count=mysqli_num_rows($result);
if($count==1){
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
        $sql="INSERT INTO `verificationcode` ( `email`, `verification code`, `time`) VALUES ( '$email', ' $verification_code', '0')";
        mysqli_query($conn, $sql);
  
              header("Location: verification2.php?email=" . $email );
              exit();
          } catch (Exception $e) {
              echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
           //  "<script>alert('Please enter a valid email');</script>";
  
              
          }
    }
else{
  echo"not excite";
}
}


?>

    
</body>
</html>