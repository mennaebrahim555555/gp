<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>log-in</h1>
    <?php
    /*
if (isset($_POST["login"]))
{
    $email = $_POST["email"];
    $password = $_POST["password"];

    // connect with database
    $conn = mysqli_connect("localhost", "root", "", "testt");

    // check if credentials are okay, and email is verified
    $sql = "SELECT * FROM users WHERE email = '" . $email . "'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 0)
    {
        echo "<script>alert('Email not found');</script>";
       // die("Email not found.");
    }

    $user = mysqli_fetch_object($result);

    if (!password_verify($password, $user->passwordinc))
    {
        echo "<script>alert('Password is not correct');</script>";
       

        //die("Password is not correct");
    

    }
/*
    if ($user->time == null)
    {
        die("Please verify your email <a href='email-verification.php?email=" . $email . "'>from here</a>");
    }
    ////
    else{
    session_start();
    $_SESSION['email']=" $email";
      header("location:home.php");
    //echo "<p>Your login logic here</p>";
    }
    exit();
}
*/
?>



<form action=""   method="post">
<input type="email" name="email" placeholder="Enter email" required /></br>
    <input type="password" name="password" placeholder="Enter password" required /></br>
<input type="submit" value="login" name="login"> <br><br>
<a href="forgetpass.php">forget password</a> </br>
    <a href="register.php">register</a> </br>



</form>
  



<?php
//هنقل البايانات من صفحة للتانية والبرنانج شغال
session_start();

if(isset($_POST['login'])){
  $password=$_POST['password'];
  $email=$_POST['email'];
  $name=$_POST['name'];

  $conn = mysqli_connect("localhost", "root", "", "testt");
  $stm="select * from users where password='$password' and email='$email'";
$result=mysqli_query($conn,$stm);
$count=mysqli_num_rows($result);
if($count==1){
$_SESSION['name']= $name;
$_SESSION['email']= $email;

  header('Location:home.php');
}
else{
 // echo"not excite";
}
}


?>
  



</body>
</html>



</body>
</html>