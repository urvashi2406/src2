
<!DOCTYPE html>
<html>
<head>
	 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title></title>

	<style type="text/css">
		body{
			background-image: url('images/5.jpg');
		}
	</style>
</head>
<body>
	 
	<form class="form-inline d-flex justify-content-center md-form form-sm mt-0" autocomplete="off" id="form">

  <i class="fa fa-search" aria-hidden="true"></i>
  <input class="form-control form-control-sm ml-3 w-75" type="text" placeholder="Search"
    aria-label="Search" id="search">
</form>
<div  id="output"></div>
<?php 
$html=$value=$_cookie="";
    include 'dbusad.php'; 
   session_start();
$sql="SELECT * from  signup";
 
  $result=mysqli_query($conn,$sql);

     if (mysqli_num_rows($result)>0)
      {  
      	$html .= "<table><tr><th>ID</th><th>Name</th><th>Username</th><th>Email</th><th>Gender</th><th>Date of Birth</th><th>Contact Number</th><th>Address</th><th>Hobbies</th><th>Picture</th></tr>";
        while($row=mysqli_fetch_assoc($result))
{ 
	 
	$html .= "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>".$row["username"]."</td><td>".$row["email"]."</td><td>".$row["gender"]."</td><td>".$row["dob"]."</td><td>".$row["phone"]."</td><td>".$row["address"]."</td><td>".$row["hobbies"]."</td><td>".$row["pic"]."</td>
<td><a href='update1.php?id=".$row['id']."' >Edit</a>"; 
$html .= " </form>
</td>

 <td>
<a href='delete1.php?id=".$row['id']."' >Delete</a> 
</td>
 </tr>";
         }

$html .= "</table>";
echo $html;
 
}

echo $_COOKIE['myCookie'];


 
   ?>
   <script type="text/javascript">
    jQuery(document).ready(function(){    
     	$("#search").keyup(function() {
     		 
        var q = $(this).val();
            
        if(q !=''){
             
            $.ajax({  

                url: "http://localhost/usad/search.php",
                method:"post",
                data: {username:q},
                dataType: "text",
                success:function(data){
                            
                	 $('#output').html(data);          
                	    }
 });
        }



		});
	 });
   </script>
</body>
</html>

                
                      