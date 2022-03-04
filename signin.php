<!DOCTYPE html>
<html>


<head>

<style type="text/css">
	* {box-sizing: border-box;}
body
{
background-color: pink !important;
padding: 6% 8%;
}
 .error
     {color: #FF0000;
      font-size: 8px;}


.yel{
	background-color:#6d7bad;

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
   
}

 

label {
  padding: 12px 12px 12px 0;
 
}

input[type=submit] {
  background-color:#6d7bad;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 16px;
  cursor: pointer;
   margin-top: 6%;
}
.bt1 {
  background-color:#6d7bad;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 16px;
  cursor: pointer;
   margin-top: 6%;
}

 
.pd{padding: 3% 0;}

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
$Error= $pwdErr=$error="";
 $username=$email=$pwd="";
 if (isset($_POST['SignIn'])){



  if (empty($_POST['username']))
  {
    $Error="Please enter a valid email or username.";
  }
  else{
    
  $username=$_POST['username'];

  }
  if (empty($_POST['pwd'])) {
  $pwdErr="Please enter a password.";}

  else
  {

  $pwd1=mysqli_real_escape_string($conn,$_POST["pwd"]);
  $pwd=md5($pwd1);
  }


  
if( (isset ($_POST['pwd'])) &&(isset ($_POST['username'])))
 {   

  $sql="SELECT * from  signup WHERE email='$username' OR username='$username'";
  $result=mysqli_query($conn,$sql);

     if (mysqli_num_rows($result)>0)
      { 
        while($row=mysqli_fetch_assoc($result))
        {
        
     if($pwd == $row['pwd'] )
      {
    $_SESSION['user_id']=$row['id'];
    $_SESSION['username']=$row['username'];
       if  ($row['role']=="user")

      {  
        header('Location:userprofile.php');}

      else { header('Location:adm.php');}
      
    }

  else
{
  $error= "Incorrect Password.";
  $pwd="";
}





}

  

  }



else
{
  $error= "No Record Found.";
}


}
else{
  $error=  "Enter proper details.";
}

}



?>

  <div class="container">
    
      
    <div class="row " >
      <div class="col-3 col-sm-3 col-md-3 col-lg-3 yel as pd">
<h1 style="color: white;position: absolute;top: 4%; left:17%;padding-top: 3%;"><strong>Log In</strong></h1>
       
 </div> 

 

   
      <div class="col-9 col-sm-9 col-md-9 col-lg-9 white pd">
        

     
           
<form method="post" class="pd" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 

<div class="row  pd " style="display: flex;
    align-items: center;" >
    <div class="col-sm-1 px-0">
  </div> 
    <div class="col-sm-2 px-0" style="text-align: center;">
       <label for="username">Username/Email</label> 
    </div>
    <div class="col-sm-7 px-0">
     <input type="text" name="username" value="<?php echo $username;?>" autocomplete="on">
    </div>
     <div class="col-sm-2"   >
        
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
   </div>
 </div>

 <div class="row pd" style="display: flex;
    align-items: center;" >
    <div class="col-sm-2 px-0">
  </div> 
    <div class="col-sm-8 px-0 text-center">
       <input type="submit" name="SignIn" value="Log In" >
     </div>

   <div class="col-sm-2" >
 </div>
</div>



<div class="row pd" style="display: flex;
    align-items: center;" >
    <div class="col-sm-2 px-0">
  </div> 
    <div class="col-sm-8 px-0 text-center">
       <a href="index.php" style="background-color:#6d7bad;color: white; font-size: 20px;padding: 2% 3%;  font-weight:strong; border-radius: 16px;">Go to Home Page..</a>
     </div> 

   <div class="col-sm-2" >
 </div>
</div>
 
 
 <div  class= "row"> 
 <div  class="col-sm-2 px-0"></div>
 <div  class="col-sm-8 px-0 " style="margin-top: 1%;">    
  <p  style="background-color: pink; color:#6d7bad; font-size: 20px; font-weight: bolder;"  ><?php echo $error;?></p>
  <p  style="background-color: pink; color:#6d7bad; font-size: 20px; font-weight: bolder;"  ><?php echo $Error;?></p>
  <p  style="background-color: pink; color:#6d7bad; font-size: 20px; font-weight: bolder;"  ><?php echo $pwdErr;?></p>
    </div>
 </div>
 <div  class="col-sm-2 px-0">
 </div>
</div>
            
  </form>
</div></div>
</div></body>