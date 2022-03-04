<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	 <meta charset="utf-8">
	 <link rel="stylesheet" type="text/css" href="styleusad.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>


 
  
  <div class="sidenav" id="mysidenav">
  <a href="#about">About</a> 	
  <a href="#services">Services</a>
  <a href="#contact">Contact</a>
  <a href="signin.php">Log In</a>
   <a href="signup.php">Register</a>
   <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
</div>

	 


	<div class="con" style="position: relative; ">
<div class="slideshow-container  px-0">
 
<div class="mySlides fade" >
 
  <img src="images/1.jpg" style="width: 100% !important; height: 300px;">
   
</div>
 
<div class="mySlides fade" >
 
  <img src="images/2.jpg" style="width: 100% !important;height: 300px;">
  
</div>
 	
<div class="mySlides fade" >
  
  <img src="images/3.jpg" style="width: 100% !important;height: 300px;">
  
</div>

</div>




<br>
 <div class="row son1">

 <div class="col-3 col-sm-3 col-md-3" >
		
	</div>
	 
	<div  class="col-6 col-sm-6 col-md-6 son">
		 <p class="adjust"><b>Welcome</b></p>
               <span id="tyty">
             </span>
             <?php echo $_COOKIE['myCookie'];?>
	</div>
	<div class="col-3 col-sm-3 col-md-3" >
		
	</div>
	 
	 </div>

</div>




	 <div class="container mgr">
 
 
<div class="row px-0 mx-0 ">
	<div class="col-12 col-sm-3 col-md-3" >
		
	</div>
	 
	<div  class="col-12 col-sm-5 col-md-5">
		<h2 style="color: blue;">Featured Places</h2>
	</div>
	<div   class="col-12 col-sm-3 col-md-3 con">
		<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
<a class="next" onclick="plusSlides(1)">&#10095;</a>
		
	</div>
	<div   class="col-12 col-sm-1 col-md-1">
		
	</div>	
	</div>
	 
</div>


 






 
</div>
<script>
var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  
  slides[slideIndex-1].style.display = "block";  
   
  setTimeout(showSlides, 1500);  
}

function myFunction() {
  var x = document.getElementById("mysidenav");
  if (x.className === "sidenav") {
    x.className += " responsive";
  } else {
    x.className = "sidenav";
  }
}


</script>




</body>
</html>