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

input[type=password]{
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
  background-color:#0d8758;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 16px;
  cursor: pointer;
   margin-top: 6%;
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
 $pwdErr =$cpassErr=$psserror=$pwdoErr=$pwdoErr="";
 $pwd =  $cpass=$pwdo=$pwdob=$pwdo1=$pwd1="";
  if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id']))
 
  { 

 $sql="SELECT * from  signup WHERE id='".$_SESSION['user_id']."'";
  
   $result=mysqli_query($conn,$sql);
    
     if (mysqli_num_rows($result)>0)
     { 
      while($row=mysqli_fetch_assoc($result))
      {
            
               
               $pwdob=$row['pwd'];
                 
                 }

             }
             

}



if (isset($_POST['submit'])){
if (empty($_POST["pwdo"])) {
    $psserror ="Enter old password.";

  } 
  else {
    $pwdo1=mysqli_real_escape_string($conn,$_POST["pwdo"]);
    $pwdo=md5($pwdo1);
    if ($pwdob==$pwdo)
  {

if (empty($_POST["pwd"])) {
    $pwdErr = " password  is required";
  } 

 elseif (strlen($_POST["pwd"])<6) {
   $pwdErr = "password should be atleast 6 characters long.";
}
  else {
    $pwd1=mysqli_real_escape_string($conn,$_POST["pwd"]);
    $pwd=md5($pwd1);
  }
 

   if (empty($_POST["cpass"])) {
    $cpassErr ="Empty field";
  } 
  else {
    $cpass1=mysqli_real_escape_string($conn,$_POST["cpass"]);
    $cpass=md5($cpass1);
  } 
 

  if(($pwd==$cpass) &&(isset ($pwd)) && (!empty($pwd)) && (isset ($cpass)) && (!empty($cpass))&&(isset ($pwdo)) && (!empty($pwdo)))   
 { $sql= "UPDATE signup SET pwd='$pwd'  WHERE  id='".$_SESSION['user_id']."'"; 
         
                 $result= mysqli_query($conn,$sql);
         if ($result>0)
     { 

      $psserror="Password updated successfully.";
      $pwd =  $cpass="";
           
        }

     else{
      $psserror="Try again.";
          }
}
    
 else{
  $cpassErr ="Passwords do not match.";
  $pwdo=$pwd =  $cpass="";
 }



}
else { $psserror="Old password is wrong.";}



}

}

?>
<div class="container">
    
      
    <div class="row " >
      <div class="col-3 col-sm-3 col-md-3 col-lg-3 yel as">
<h1 style="color: white;position: absolute;top: 2%;">Update Password</h1>
       
 </div> 

 

   
      <div class="col-9 col-sm-9 col-md-9 col-lg-9 white py-5">
        

    <div class="row">
      <div class="col-1 col-sm-1 col-md-1 col-lg-1">
      </div>
      <div class="col-10 col-sm-10 col-md-10 col-lg-10">

           




<form method="post" id="myForm"action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 


<div class="row px-0 " style="display: flex;
    align-items: center;" >
    <div class="col-sm-1 px-0">
  </div> 
    <div class="col-sm-2 px-0" style="text-align:center;">
   <label for="pwdo">Old Password</label>
 </div>
 <div class="col-sm-7 px-0">
  <input type="password" name="pwdo" value="<?php echo $pwdo;?>">
  </div>
   <div class="col-sm-2" style="display: flex;
    align-items: center;" >
  <span class="error">* <?php echo $pwdoErr;?></span>
   </div>
 </div>
  

  <div class="row px-0 " style="display: flex;
    align-items: center;" >
    <div class="col-sm-1 px-0">
  </div> 
    <div class="col-sm-2 px-0" style="text-align:center;">
   <label for="pwd">New Password</label>
 </div>
 <div class="col-sm-7 px-0">
  <input type="password" name="pwd" value="<?php echo $pwd;?>">
  </div>
   <div class="col-sm-2" style="display: flex;
    align-items: center;" >
  <span class="error">* <?php echo $pwdErr;?></span>
   </div>
 </div>
  
<div class="row px-0 " style="display: flex;
    align-items: center;">
    <div class="col-sm-1 px-0">
  </div> 
    <div class="col-sm-2 px-0" style="text-align:center;">
   <label for="cpass">Confirm New Password</label>
 </div>
 <div class="col-sm-7 px-0">
  <input type="password" name="cpass" value="<?php echo $cpass;?>">
  </div>
   <div class="col-sm-2" style="display: flex;
    align-items: center;" >
  <span class="error">* <?php echo $cpassErr;?></span>
   </div>
 </div>
   
     
<div class="row px-0 " style="display: flex;
    align-items: center;" >
    <div class="col-sm-2 px-0">
  </div> 
    <div class="col-sm-4 px-0">
       <input type="submit" name="submit" value="Submit" >

  </div>
        <div class="col-sm-4 px-0">   
 <button class="bt1"><a href="index.php" style=" color: white;">Log Out</a></button>
  </div>
 <div class="col-sm-2" >
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
 
     
</form>



</div>


  </div>
    
  </div>
  </div>
</body>