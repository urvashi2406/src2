<head>
<style type="text/css">
	* {box-sizing: border-box;}
body
{
 
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
 
 $nameErr =  $genderErr = $phoneErr = $dobErr= $addressErr=$psserror=$usernameErr=$emailErr="";
 $name =  $gender = $phone= $dob= $address=$pic=$hobbies=$username=$email="";
  $id=$_GET['id'];
 if(isset($_GET['id']))
{
   $sql1="SELECT * from signup WHERE id='".$id."'";
    $result1=mysqli_query($conn,$sql1);
 
    if (mysqli_num_rows($result1)>0)
     { 
     	while($row=mysqli_fetch_assoc($result1))
     	{
     		     $id=$row['id'];
           $name=$row['name'];
               $dob =$row['dob'];
            $gender=$row['gender']; 
              $phone =$row['phone'];
           $address =$row['address'];
               $pic=$row['pic'];
               $hobbies=$row['hobbies'];
               $username=$row['username'];
               $email=$row['email'];              
                  }

             }
        }    
 
   function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;

} 

 


 if(isset($_POST["submit"])){
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

    $sql3="SELECT username from signup where username='$username' ";

    $result3 = mysqli_query($conn,$sql3);
     
     if((mysqli_num_rows($result3))>1)
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
    $sql4="SELECT email from signup where email='$email' ";

    $result4 = mysqli_query($conn,$sql4);
     
     if((mysqli_num_rows($result4))>1)
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
   
    }
  

 
if (empty($_POST["address"])) {
    $addressErr = "address is required";
  } else {
    $address= test_input($_POST["address"]);
  }

 


if (empty($_POST["dob"])){
    $dobErr = "Choose your date of birth.";
  } 
  else{
       date_create();
       if($dob> date("Y-m-d") ) {
                 $dobErr= "Incorrect date";}
  }

 if(isset($_POST["dob"]))
{$dob=$_POST["dob"];}
if(isset($_POST["hobbies"]))
{
 $hobbies=$_POST["hobbies"];}
 
$target_dir = "pictures/";
 $pic = $target_dir . basename($_FILES["pic"]["name"]);
$uploadOk = 1;
 $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); 
// Check if image file is a actual image or fake image

  $check = getimagesize($_FILES["pic"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }

if((isset ($name)) && (!empty($name)) && (isset ($address))&& (!empty($address))&& (isset ($phone)) && (!empty($phone)) && (isset ($gender)) && (!empty($gender)) )   
{

  
   $sql="UPDATE signup SET name='$name',username='$username',email='$email',gender='$gender',phone='$phone',hobbies='$hobbies',address='$address',pic='$pic',dob='$dob' WHERE id='$id'"; 
      if (mysqli_query($conn,$sql))
     { 
	$value = "Record updated.";
setcookie("myCookie", $value, time()+5);
   header('Location:adm.php');}
else {
	$value = "Try again.";

 
setcookie("myCookie", $value, time()+5);

   header('Location:adm.php');
}

}
      

}





 ?>

<div class="container">
   	
    	
   	<div class="row " >
   		<div class="col-3 col-sm-3 col-md-3 col-lg-3 yel as">
<h1 style="color: white;position: absolute;top: 2%;"><strong>Admin edit rights</strong></h1>
   	   
 </div> 

 

   
   		<div class="col-9 col-sm-9 col-md-9 col-lg-9 white py-5">
   			

   	<div class="row">
   		<div class="col-1 col-sm-1 col-md-1 col-lg-1">
   		</div>
   		<div class="col-10 col-sm-10 col-md-10 col-lg-10">

           
<form method="post" id="myForm"  enctype="multipart/form-data"> 

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

<div class="row px-0" style="display: flex;
    align-items: center;">
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
  <input type="date" name="dob" id="dob" value="<?php echo $dob;?>">
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
   
  if($gender==$x_value){
      echo '<input type="radio"  name="gender" value="'.$x_value.'" checked>'. $x_value;

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
 	  
 	<input type="file" id="pic" name="pic"    value=" <?php echo $pic; ?>" >
   
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
    <div class="col-sm-2 px-0">
  </div> 
    <div class="col-sm-4 px-0">
    	 <input type="submit" name="submit" value="Submit" >

  </div>
        <div class="col-sm-4 px-0">   
   <button class="bt1">  <a href="adm.php" style=" color: white; ">Go Back</a></button>
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
