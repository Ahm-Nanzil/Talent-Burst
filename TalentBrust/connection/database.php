<?php 
$severname="localhost";
$username="root";
$password="";
$database="talentbrust";
$connection=mysqli_connect($severname,$username,$password,$database);
if(!$connection){
  die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>