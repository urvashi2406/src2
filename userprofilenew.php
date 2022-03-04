<!DOCTYPE html>
<html>


<head>

<style type="text/css">
	* {box-sizing: border-box;}
body
{
padding: 6% 5%;
background-image: url('images/4.jpg');
}
.white{
	background-color: white;
}
 .bt1 {
  background-color:white;
 
  padding: 12px 20px;
  border: none;
  border-radius: 16px;
  cursor: pointer;
   margin-top: 6%;
}

</style>
<meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" type="text/css" href="styleusad.css">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</head>


<body>


<?php 
  include 'dbusad.php'; 
   session_start();
    
 
/*if(isset($_SESSION['name']) && !empty($_SESSION['name']))
 {$sql="SELECT * from  signup WHERE name='".$_SESSION['name']."'";
  
   $result=mysqli_query($conn,$sql);
    
     if (mysqli_num_rows($result)>0)
     { 
     	while($row=mysqli_fetch_assoc($result))
     	{
             
               $_SESSION['username']=$row ['username'];
                 }

             }
             
  
}*/

 
?>

<div class="container">
<div style="margin-left: 25%;">
<h1 style="color: white;position: absolute;top: 10%;">Welcome <?php if(isset($_SESSION['name']))  echo $_SESSION['username'];?></h1>
       <button class="bt1"><a href="logout.php" style=" color: #0d8758;"><strong>Log Out</strong></a></button>
    </div>
  </div>