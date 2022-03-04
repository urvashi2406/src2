<!DOCTYPE html>
<html>


<head>

<style type="text/css">
	* {box-sizing: border-box;}
body
{
background-image: url('images/4.jpg');
padding: 6% 5%;
}
 .error
     {color: #FF0000;
      font-size: 8px;}


.yel{
	background-color:#0d8758;

position: relative;}

	.as{
	  
	   display: flex;
	   align-items: center;
}

 

.white{
	background-color: white;
}

input[type=text],input[type=password]{
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}

 

label {
  padding: 12px 12px 12px 0;
 
}

input[type=submit] {
   display: flex;
  justify-content: center;
  color:#0d8758;
position: absolute;
  background-color: white;
   padding: 1% 7%;
  border: none;
  border-radius: 16px;
  cursor: pointer;
   
}
.bt1 {
  background-color:#0d8758;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 16px;
  cursor: pointer;
   margin-top: 6%;
}

.bt2 {
  display: flex;
  justify-content: center;
  background-color:white;
  color:#0d8758;
 padding: 1% 7%;
  border: none;
  border-radius: 16px;
  cursor: pointer;
   
   position: absolute;
}
 

</style>
<meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>


<body>

<?php 
  include 'dbusad.php'; 
 session_start();
 $emailErr= $pwdErr=$psserror="";
 $email= $pwd="";
  if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id']))
 
	{ 

 $sql1="SELECT * from  signup WHERE id='".$_SESSION['user_id']."'";
           $result1= mysqli_query($conn,$sql1);
 if (mysqli_num_rows($result1)>0)
     { 
      while($row=mysqli_fetch_assoc($result1))
      {
            
               
               $pwdob=$row['pwd'];
                $emailob=$row['email']; 
                 }

             }
  
   
}
 
   function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;

} 

if (isset($_POST['submit'])){


  if (empty($_POST['email']))
  {
    $Error="Please enter a valid email.";
  }
  else{
      $email=$_POST['email'];

  }
  if (empty($_POST['pwd'])) {
  $pwdErr="Please enter a password.";}

  else
  {

  $pwd1=mysqli_real_escape_string($conn,$_POST["pwd"]);
  $pwd=md5($pwd1);
  }



  
if((isset($_POST['email'])) && (!empty($_POST['email'])) && (isset($_POST['pwd'])) &&(!empty($_POST['pwd'])))
 {   


     if ($email==$emailob){


      if($pwdob==$pwd){  
      
   $sql2 ="DELETE FROM signup WHERE email='$email' AND pwd='$pwd'";
  $result2=mysqli_query($conn,$sql2);

     if($result2){$value = "Record deleted.";
setcookie("myCookie", $value, time()+5);
     header('Location:index.php');
   }
else {
  $value = "Try again.";
setcookie("myCookie", $value, time()+5);
   header('Location:userprofile.php');
       }
             
   } 
      
     else
      { $psserror="You entered wrong password.";
      $pwd="";              
      }
    }
      else
      {
        $psserror="You entered wrong email.";
        $email="";
      }
   } 
  else
{
  $psserror= "Enter both fields.";
  $pwd=$email="";
}

}
 


 





  ?>

<div class="container">
   	
    	
   	<div class="row " >
   		<div class="col-3 col-sm-3 col-md-3 col-lg-3 yel as">
<h2 style="color: white;position: absolute;top: 2%;">Delete Account</h2>
   	   
 </div> 

 

   
   		<div class="col-9 col-sm-9 col-md-9 col-lg-9 white py-5">
   			

   	<div class="row">
   		<div class="col-1 col-sm-1 col-md-1 col-lg-1">
   		</div>
   		<div class="col-10 col-sm-10 col-md-10 col-lg-10">

           
<form method="post" id="myForm"action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 

 <div class="row pd " style="display: flex;
    align-items: center;">
    <div class="col-sm-1 px-0">
  </div> 
    <div class="col-sm-2 px-0" style="text-align:center;">
   <label for="email">Email</label>
 </div>
<div class="col-sm-7 px-0">
  <input type="text" name="email" value="<?php echo $email;?>">
</div>
   <div class="col-sm-2">
    <span class="error"><?php echo $emailErr; ?></span>
   </div>
 </div>

<div class="row pd " style="display: flex;
    align-items: center;" >
    <div class="col-sm-1 px-0">
  </div> 
    <div class="col-sm-2 px-0" style="text-align:center;">
   <label for="pwd">Password</label>
 </div>
 <div class="col-sm-7 px-0">
  <input type="password" name="pwd" value="<?php echo $pwd;?>">
  </div>
   <div class="col-sm-2" >
     <span class="error"><?php echo $pwdErr; ?></span>
   </div>
 </div>
  
      
  
  
 
 <div  class= "row w-100" style="margin-top: 5%;"> 
  <div class="col-sm-3 px-0">
  </div> 
   <div class="col-sm-6 px-0 ">
   
  <p  style="background-color: pink; color:#6d7bad; font-size: 20px; font-weight: bolder;"  ><?php echo $psserror;?></p> 
   </div>
 <div class="col-sm-3 px-0">
  </div> 
  </div>

 <div  class= "row w-100" style="margin-top: 5%;"> 
  <div class="col-sm-2 px-0">
  </div> 
   <div class="col-sm-8 px-0 text-center " id="trythat"style="background-color:#0d8758; color: white;border-radius: 16px;padding:4% 10% 10% 10%;position: relative;display:none;">
    <p style="margin-top: 0%;">Are you sure you want to delete your account?</p>
    <input type="submit" name="submit" value="Yes" style="left:20%;"> 
    <button class="bt2" style="right:20%;" onclick="re()">No</button>
   </div>
 <div class="col-sm-2 px-0">
  </div> 
  </div>
 
     
</form>

 <div class="row px-0 " style="display: flex;
    align-items: center;" >
    <div class="col-sm-2 px-0">
  </div> 
    <div class="col-sm-4 px-0">
      <button class="bt1" onclick="ask();">Delete Account</button>
  </div>
        <div class="col-sm-4 px-0">   
   <button class="bt1"><a href="index.php" style="color: white;">Log Out</a></button>
  </div>
 <div class="col-sm-2" >
 </div>
</div>



</div>


	</div>
   	
  </div>
  </div>
</div>
<script type="text/javascript">
  function ask(){
    
    
  var x = document.getElementById("trythat");
   
    x.style.display = "block";
    
        <?php 
         $email=$pwd="";
    ?>
   
}
function re()
{
  var x = document.getElementById("trythat");
   
    x.style.display = "none";
    <?php 
         $email=$pwd="";
    ?>

}
   
</script>
</body>