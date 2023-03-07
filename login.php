
<?php  
 session_start();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <title>Document</title>
</head>

<body>
<?php 
 require_once('admin/dbconnect.php');

if(isset($_POST['send']))
{
  
$email=trim($_POST['email']);
$pass=md5(trim($_POST['password']));
echo $pass ;
//-----------------------------------------
$error=array();
// ----------------------------------------
 if(empty($email)||empty($pass))
 {
    $error['empty']='The field is requered';
 }
 else
{
    $sql="SELECT * from users WHERE email=? AND password=?";
    $stm= $conn -> prepare($sql);
    $stm->execute(array($email,$pass)); 
    if( $stm->rowCount()==1)
    {
       $_SESSION['user_info'] =$stm->fetch();
       echo $_SESSION['user_info']['name'];
       if($_SESSION['user_info']['role_id']==1)
       {
        header("location:admin/index.php");
       }
       else{
        header("location:admin/profile.php");
       } 
    }
    //--------------------
    else{
        echo ' Occerd Wrong';
    }
} //end of post method
}//end if(isset)
?>
    <div class="wrapper fadeInDown">
        <div id="formContent">
            <!-- Tabs Titles -->
            <h2 class="active"> Sign In </h2>
            <h2 class="inactive underlineHover">Sign Up </h2>
            <!-- Icon -->
            <div class="fadeIn first">
                <h3> <i class="fa fa-users "></i></h3>
            <!-- <i class="fa fa-twitter"> -->
            <!-- <img src="http://danielzawadzki.com/codepen/01/icon.svg" id="icon" alt="User Icon" /> -->
            </div>

            <!-- Login Form -->
            <form action="" method="post">
                <input type="email" id="login" class="fadeIn second" name="email" placeholder="Email" >
                <input type="password" id="password" class="fadeIn third" name="password" placeholder="password" > 
                <input type="submit" name='send' class="fadeIn fourth" value=" login">
            </form>
            <!-- Remind Passowrd -->
            <div id="formFooter">
                <a class="underlineHover" href="#">Forgot Password?</a>
            </div>

        </div>
    </div>

</body>
</html>









