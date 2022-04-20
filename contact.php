<html>
<head>
<title>contactform</title>
 <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
 <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" media="screen" rel="stylesheet">
  <style>
  form #website{ display:none; }
  </style>
  

</head>

<body>
<h2>contact </h2>
<div class="container">
<form method="post" action="" id="formone">

  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" id="name" name="name"  placeholder="Enter Your Name" required>

  </div>
  <div class="form-group">
    <label for="mobile">Mobile</label>
    <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter Your Mobile"  minlength="10" maxlength="10"  required  >
    <span id="mob" name="mob"></span>
  </div>
  <div class="form-group ">
    <label for="email">Email</label>
	
    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email"  onkeyup="checkmobile();"required >
 
  </div>
  <div class="form-group">
    <label for="subject">Subject</label>
    <input type="text" class="form-control" id="subject"  name="subject" placeholder="Enter Subject" required>

  </div>
  <div class="form-group">
    <label for="msg">Message</label>
    <input type="text" class="form-control" id="msg"  name="msg" placeholder="Message">
	

  </div>
  <div class="form-group">
    <label for="city">City</label>
   <select  class="form-select" name="city" id="city">
   <option selected>Select City</option>
   <option>Delhi</option>
   <option>Mumbai</option>
   <option>Bangalore</option>
   </select>

  </div>
  <input type="text" id="website" name="website"/>
  <button type="submit" class="btn btn-primary"  id="submit" name="submit">Submit</button>
</form>
</div>

</body>
<script>
function checkmobile(val) {
	$.ajax({
	type: "POST",
	url: "checkmobile.php",
	data:'mobile='+val,
	success: function(data){
		$("#mob").html(data);
	}
	});
}

</script>
</html>
<?php

if(isset($_POST['submit'])){
	$name=$_POST['name'];
$mobile=$_POST['mobile'];
$email=$_POST['email'];
$subject=$_POST['subject'];
$msg=$_POST['msg'];
$city=$_POST['city'];
function validate_mobile($mobile)
{
	
     return preg_match('/^[0-9]{10}+$/', $mobile);
}
include "dbconfig.php";



if (validate_mobile($mobile) == true) {
   echo "Mobile number is valid";
} else {
  echo "Invalid mobile number";
}
function checkemail($email) {
         return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) ? FALSE : TRUE;
   }
   if(!checkemail($email)){
      echo "Invalid email address.";
   }
   else{
      echo "Valid email address.";
   }
   if(!empty($_POST['website'])) die();
   
	$email=$_POST['email'];
	$mobile=$_POST['mobile'];
	
	$sql1="select * from demo where   mobile='$mobile' or email='$email' ";
	$query = mysqli_query($conn,$sql1);
	if(mysqli_num_rows($query) >0)
    {
    echo "data already exists";}
        else{
            
   $sql = "INSERT INTO demo (name,mobile,email,subject,message,city)
VALUES ('$name','$mobile','$email','$subject','$msg','$city')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
        }
   unset($name);
   unset($email);
   unset($mobile);
   unset($subject);
   unset($msg);
   unset($city);

}

?>