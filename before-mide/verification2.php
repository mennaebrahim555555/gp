<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="POST">
    <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>" required>
     <input type="text" name="verification_code" placeholder="Enter verification code" required />
 
    <input type="submit" name="verify_email" value="Verify Email">
</form>

<?php
if (isset($_POST["verify_email"]))
{
  /////////no error
  //error_reporting(0);
     $email = $_POST["email"];
     

    $verification_code = $_POST["verification_code"];
   
    
  $conn = mysqli_connect("localhost", "root", "", "testt");

    
   $sql ="UPDATE `verificationcode` SET `time`=NOW() WHERE `verificationcode`.`email`='$email' and  `verificationcode`.`verification code`=$verification_code ;";
    
    $result  =mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) == 0)
    {
      
     die("Verification code failed.");
    }
    else{


  $conn = mysqli_connect("localhost", "root", "", "testt");
  session_start();
   $password=$_SESSION['password'];
   // $sql = "INSERT INTO users(username, email, password,phonenum) VALUES ('" .  $_SESSION['name'] . "', '" . $email . "', '" .$_SESSION['password'] . "', '" .  $_SESSION['phonenum'] . "')";
    $sql =" UPDATE users   SET password= '$password' where email='$email'  ";
    

  mysqli_query($conn, $sql);
 // header("location:home.php");

  echo "<p>You can login now.</p>";
    }
  //  exit();

}
      
     
    



?>
</body>
</html>








