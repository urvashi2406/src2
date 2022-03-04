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
 
if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id']))
 {$sql="SELECT * from  signup WHERE id='".$_SESSION['user_id']."'";
  
   $result=mysqli_query($conn,$sql);
    
     if (mysqli_num_rows($result)>0)
     { 
     	while($row=mysqli_fetch_assoc($result))
     	{
             
                
                 }

             }
             
  


 
?>

<div class="container">
   	 <div class="sidenav" id="mysidenav">
  <a href="index.php">Home</a>  
  <a href="update.php">Update Profile</a>
  <a href="password.php">Change Password</a>
  <a href="delete.php">Delete Account</a>
   <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>

 </div>
    	
   	 <div style="margin-left: 25%;">
<h1 style="color: white;position: absolute;top: 10%;">Welcome <?php if(isset($_SESSION['user_id']))  echo $_SESSION['username'] ; ?> </h1>
<?php if (isset($_COOKIE['myCookie'])) echo $_COOKIE['myCookie'];
      if (isset($_SESSION['success']) &&(!empty($_SESSION['success']))) {
        echo '<h2>'.$_SESSION['success'].'</h2>';
        unset($_SESSION['success']);
         
      }
?>

   	   <button class="bt1"><a href="logout.php" style=" color: #0d8758;"><strong>Log Out</strong></a></button>
    </div>
    <script type="text/javascript">
      function myFunction() {
  var x = document.getElementById("mysidenav");
  if (x.className === "sidenav") {
    x.className += "responsive";
  } else {
    x.className = "sidenav";
  }
}
    </script>
  <?php } ?>
    </body>
    </html>


   	 