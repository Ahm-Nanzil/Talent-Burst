<?php 
$severname="localhost";
$username="root";
$password="";
$database="talentbrust";
$conn=mysqli_connect($severname,$username,$password,$database);
if(!$conn){
  die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>