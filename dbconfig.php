<?php
$hostname="localhost";
$username="root";
$password="";
$database="contactdemo";
$conn=mysqli_connect($hostname,$username,$password,$database);
if(!$conn)
	echo "datavase not connected";


?>