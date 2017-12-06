<?php
include 'FinalProjectModel.php';


$user = $_POST['user'];
$pass = $_POST['pass'];

$response = login($user, $pass);

if(response[0] == true)
{
    header("Location: index.php");
    
}else{
echo response [1];
    header("Location: login.php");
}


?>
