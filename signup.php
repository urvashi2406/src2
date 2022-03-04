<!DOCTYPE html>
<html>


<head>

<style type="text/css">
	* {box-sizing: border-box;}
body
{
background-color: pink !important;
padding: 6% 5%;
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

input[type=text],input[type=date],input[type=password], select, textarea {
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
     $gender1 = array("0"=>"female", "1"=>"male", "2"=>"other");
 $nameErr =$usernameErr= $emailErr = $genderErr = $phoneErr = $dobErr= $addressErr=$cpassErr= $pwdErr=$psserror="";
$name = $username=$email = $gender = $comment = $phone = $dob=$address= $cpass= $pwd=  $hobbies=$pic="";
   function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;

} 

if (isset($_POST['submit'])){



  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
   
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
      $name="";
    }
  }

  if (empty($_POST["username"])) {
    $usernameErr = "Username is required";
  } else {

  	$username = test_input($_POST["username"]);

    if (!preg_match("/^[a-zA-Z0-9 ]*$/",$username)) {
      $usernameErr = "Only letters, numbers and white space allowed";
    }

    $sql1="SELECT username from signup where username='$username' ";

    $result1 = mysqli_query($conn,$sql1);
     
     if((mysqli_num_rows($result1))>0)
     {
     	$usernameErr="Username already exists.";
     	$username="";
     }
 
}


  
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } 
  else {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
    $sql3="SELECT email from signup where email='$email' ";

    $result3 = mysqli_query($conn,$sql3);
     
     if((mysqli_num_rows($result3))>0)
     {
     	$emailErr="This email already exists.";
     	$email="";
     }
  }
     
  

  if (empty($_POST["gender"])) {

    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }



if (empty($_POST["phone"])) {
    $phoneErr = "Contact number is required";
  } else {
    $phone = test_input($_POST["phone"]);
    if(!preg_match('/^[0-9]{10}$/', $_POST["phone"]))
      {$phoneErr = "Invalid contact number";}
   $sql2="SELECT phone from signup where phone='$phone'";

    $result2 = mysqli_query($conn,$sql2);
     
     if((mysqli_num_rows($result2))>0)
     {
     	$phoneErr="This contact number already exists.";
     	$phone="";
     }
    }
  

 
if (empty($_POST["address"])) {
    $addressErr = "address is required";
  } else {
    $address= test_input($_POST["address"]);
  }

 
if (empty($_POST["pwd"])) {
    $pwdErr = " password  is required";
  } 

elseif (strlen($_POST["pwd"])<6) {
   $pwdErr = "password should be atleast 6 characters long.";
}
  else {
    $pwd=mysqli_real_escape_string($conn,$_POST["pwd"]);
  }
 
   if (empty($_POST["cpass"])) {
    $cpassErr ="Empty field";
  } 
  else {
    $cpass= test_input($_POST["cpass"]);
  } 

if (empty($_POST["dob"])){
    $dobErr = "Choose your date of birth.";
  } 
  else{
       date_create();
       if($dob> date("Y-m-d") ) {
                 $dobErr= "Incorrect date";}
  }

 if($pwd==$cpass)
 {  }
 else{
 	$cpassErr ="passwords do not match.";
 }

$dob=$_POST["dob"];



 
if(!empty($_FILES["pic"]))
{
$files=$_FILES["pic"];
$filetemp=$files['tmp_name'];


$filename=$files['name'];
$fileext=explode('.',$filename);
$filecheck= strtolower(end($fileext));
$fileextstored=array('png','jpg','jpeg');
if(in_array($filecheck,$fileextstored))
{
  $pic='pictures/'.$filename;
  move_uploaded_file($filetemp,$pic);
}
else{$psserror="This image format is not supported.";}
}



$hobbies=	$_POST["hobbies"];

  if((isset ($name)) && (!empty($name)) &&(isset ($email)) && (!empty($email))&& (isset ($username)) && (!empty($username))&& (isset ($address))&& (!empty($address))&& (isset ($phone)) && (!empty($phone)) && (isset ($gender)) && (!empty($gender)) && (isset ($pwd)) && (!empty($pwd)) && (isset ($cpass)) && (!empty($cpass)))   

   {
if ($pwd==$cpass)
 { $pwdn=md5($pwd);
     
 	

 $sql="INSERT into signup (name ,email,pwd,pic,gender,address,phone,dob,username,hobbies,role) VALUES('$name','$email','$pwdn','$pic','$gender','$address','$phone','$dob','$username','$hobbies','user')";

    
   /*  if (mysqli_query($conn,$sql))
     { 
            ?>
       <script type="text/javascript">
      jquery(document).ready(function()

      });
        func1(){ alert("hello");
          var elements=myForm.elements;
          myForm.reset();


          for(var i=0;i<elements.length;i++)
          {
            field_type=elements[i].type.toLowerCase();

            switch(field_type){
              case"text":
              case "password":
              case "textarea":
              case "file":
              case  "date":

elements[i].value="";
break;

   case "radio":
   case"checkbox":
             if(elements[i].checked){
                 elements[i].checked= false;
             }
     break;



     default:
     break;
            }
          }
       }
     */
     //func1();
       
       $result=mysqli_query($conn,$sql);

     if  ($result) 
         {
         $_SESSION['name']=$name;
         $_SESSION['username']=$username;

      header('Location:userprofilenew.php');

}
     
     else{
      $psserror= "Please Try Again !";
     }

}


}
  
 }



  	 ?>

  <div class="container">
   	
    	
   	<div class="row " >
   		<div class="col-3 col-sm-3 col-md-3 col-lg-3 yel as">
<h1 style="color: white;position: absolute;top: 2%;"><strong>Register</strong></h1>
   	   
 </div> 

 

   
   		<div class="col-9 col-sm-9 col-md-9 col-lg-9 white py-5">
   			

   	<div class="row">
   		<div class="col-1 col-sm-1 col-md-1 col-lg-1">
   		</div>
   		<div class="col-10 col-sm-10 col-md-10 col-lg-10">

           
<form method="post" id="myForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" autocomplete="on" enctype="multipart/form-data"> 

<div class="row px-0" style="display: flex;
    align-items: center;" >
    <div class="col-sm-1 px-0">
  </div> 
    <div class="col-sm-2 px-0" style="text-align: center;">
      <label for="name">Full Name</label>
    </div>
    <div class="col-sm-7 px-0">
     <input type="text" name="name" value="<?php echo $name;?>">
    </div>
     <div class="col-sm-2" style="display: flex;
    align-items: center;" >
       <span class="error">* <?php echo $nameErr;?></span>
  </div> 
</div>


<div class="row px-0" >
    <div class="col-sm-1 px-0">
  </div> 
    <div class="col-sm-2 px-0" style="text-align:center;">
      <label for="username">Username</label> 
    </div>
    <div class="col-sm-7 px-0">
     <input type="text" name="username" id="fgh" value="<?php echo $username;?>">
    </div>
     <div class="col-sm-2" style="display: flex;
    align-items: center;" >
       <span class="error">* <?php echo $usernameErr;?></span>
  </div> 
</div>



 
    <div class="row px-0 " style="display: flex;
    align-items: center;">
    <div class="col-sm-1 px-0">
  </div> 
    <div class="col-sm-2 px-0" style="text-align:center;">
   <label for="email">Email</label>
 </div>
<div class="col-sm-7 px-0">
  <input type="text" name="email" value="<?php echo $email;?>">
</div>
   <div class="col-sm-2" style="display: flex;
    align-items: center;" >
  <span class="error">* <?php echo $emailErr;?></span>
   </div>
 </div>

<div class="row px-0 " style="display: flex;
    align-items: center;">
    <div class="col-sm-1 px-0">
  </div> 
    <div class="col-sm-2 px-0" style="text-align:center;">
   <label for="dob">Date Of Birth</label>
 </div>
<div class="col-sm-7 px-0">
  <input type="date" name="dob" id="dob">
</div>
   <div class="col-sm-2" style="display: flex;
    align-items: center;" >
  <span class="error">* <?php echo $dobErr;?></span>
   </div>
 </div>

<div class="row px-0 " style="display: flex;
    align-items: center;" >
    <div class="col-sm-1 px-0">
  </div> 
    <div class="col-sm-2 px-0" style="justify-content:space-around;display: flex;
    padding-top: 3px;">
   <label for="gender">Gender</label>
 </div>
 <div class="col-sm-7 px-0" style="display: flex;
    align-items: center;justify-content: space-evenly;">
<?php
    $gender1 = array("0"=>"female", "1"=>"male", "2"=>"other");

foreach($gender1 as $x => $x_value) {
   
  if(isset($gender) && $gender==$x_value){
      echo '<input type="radio" name="gender" value="'.$x_value.'" checked>'. $x_value;

 }else{
      echo '<input type="radio" name="gender" value="'.$x_value.'">'. $x_value;

 }
  
  }


      

?>

  </div>
   <div class="col-sm-2" style="display: flex;
    align-items: center;" >
  <span class="error">* <?php echo $genderErr;?></span>
   </div>
 </div>





   <div class="row px-0 " style="display: flex;
    align-items: center;" >
    <div class="col-sm-1 px-0">
  </div> 
    <div class="col-sm-2 px-0" style="text-align:center; ">
   <label for="phone">Contact Number</label>
 </div>
  <div class="col-sm-7 px-0">
     <input type="text" name="phone" value="<?php echo $phone;?>">
    </div>
   <div class="col-sm-2" style="display: flex;
    align-items: center;" >
   <span class="error">* <?php echo $phoneErr;?></span>
   </div>
 </div>







  <div class="row px-0" style="display: flex;
    align-items: center;" >
    <div class="col-sm-1 px-0">
  </div> 
    <div class="col-sm-2 px-0" style="text-align:center;">
   <label for="address">Address</label>
 </div>
<div class="col-sm-7 px-0">
  <input type="text" name="address" value="<?php echo $address;?>">
  </div>
   <div class="col-sm-2" style="display: flex;
    align-items: center;" >
  <span class="error">* <?php echo $addressErr;?></span>
   </div>
 </div>



<div class="row px-0 " style="display: flex;
    align-items: center;" >
    <div class="col-sm-1 px-0">
  </div> 
    <div class="col-sm-2 px-0" style="text-align:center;">
   <label for="pic">Profile Picture</label>
 </div>
 <div class="col-sm-7 px-0">
 	<input type="file" id="pic" name="pic">
   
  </div>
   <div class="col-sm-2" style="display: flex;
    align-items: center;" >
  
   </div>
 </div>


<div class="row px-0 " style="display: flex;
    align-items: center;" >
    <div class="col-sm-1 px-0">
  </div> 
    <div class="col-sm-2 px-0" style="text-align:center;">
   <label for="hobbies">Interests</label>
 </div>
 <div class="col-sm-7 px-0">
 	 <textarea   name="hobbies"rows="2" cols="30" style="margin: 1% 0;"><?php echo $hobbies;?></textarea>
    
  </div>
   <div class="col-sm-2" style="display: flex;
    align-items: center;" >
     </div>
 </div>
  

<div class="row px-0 " style="display: flex;
    align-items: center;" >
    <div class="col-sm-1 px-0">
  </div> 
    <div class="col-sm-2 px-0" style="text-align:center;">
   <label for="pwd">Password</label>
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
   <label for="cpass">Confirm Password</label>
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
   <input type="button" class="bt1" value="Reset Form" onClick="func1()" />
    <!--"this.form.reset()"-->
  </div>
 <div class="col-sm-2" >
 </div>
</div>
  
 
 <div  class= "row w-100" style="margin-top: 5%;"> 
  <div class="col-sm-3 px-0">
  </div> 
   <div class="col-sm-6 px-0 ">
   <a href="index.php" style="background-color:#6d7bad;color: white; font-size: 20px;padding: 2% 3%;  font-weight:strong; border-radius: 16px;">Go to Home Page..</a>
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


   </div>

<script type="text/javascript">
 function func1()
  {     
  }
</script>

</body>
 </html>