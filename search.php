<?php
include 'dbusad.php';
session_start();
 
$out="";
if (isset($_POST['username']))
{
	$q=$_POST['username']; 
   $q=htmlentities($q);
   $q=mysqli_real_escape_string($conn,$q);
  echo $sql="SELECT * from signup WHERE username='$q' OR username LIKE '$q%' OR username LIKE '%$q' OR username LIKE '%$q%'";
   $result=mysqli_query($conn,$sql);
   if(mysqli_num_rows($result)>0)
   {
   	
     	$out .= "<table><tr><th>ID</th><th>Name</th><th>Username</th><th>Email</th><th>Gender</th><th>Date of Birth</th><th>Contact Number</th><th>Address</th><th>Hobbies</th><th>Picture</th></tr>";

   while ($row=mysqli_fetch_assoc($result)) {
 $out .="<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>".$row["username"]."</td><td>".$row["email"]."</td><td>".$row["gender"]."</td><td>".$row["dob"]."</td><td>".$row["phone"]."</td><td>".$row["address"]."</td><td>".$row["hobbies"]."</td><td>".$row["pic"]."</td></tr>"; 
}

$out .= "</table>";
echo $out;
 
}  
       

   	 
   else{
   	echo "<p class='red-text'>No data found</p>";
   }
}
else
{
	echo "<p class='red-text'>Bad Request</p>";
}
?>