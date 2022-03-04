<?php
include 'dbusad.php';
if(isset($_GET['id']))
{
  $sql1="DELETE from signup WHERE id='".$_GET['id']."'";
    $result1=mysqli_query($conn,$sql1);
   if($result1)
   {
   	$value = "Record deleted.";
setcookie("myCookie", $value, time()+5);
   header('Location:adm.php');
   }
else {
	$value = "Try again.";
setcookie("myCookie", $value, time()+5);
   header('Location:adm.php');}
     
}


?>