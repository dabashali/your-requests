<?php 
$dsn="mysql:host=localhost;dbname=resturant";
$user="root";
$pass="";
$option=array(
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
);
try{
   $conn= new pdo($dsn,$user,$pass,$option);
    $conn->setAttribute(PDO::ATTR_ERRMODE ,PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES ,FALSE);
    // echo "connect";
}
catch(PDOException $q)
{
    echo $q->getMessage();
}
?>