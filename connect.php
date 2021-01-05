<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "pblgps";

// $servername = "localhost";
// $username = "pblgpsco_pblgpsco";
// $password = "D10m12y37";
// $database = "pblgpsco_hero";

// Create connection
$conn = new mysqli($servername, $username, $password,$database);
mysqli_set_charset($conn, 'utf8');

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}else{
    // echo "ASD";
}

header("Access-Control-Allow-Origin: *");
    
header("Content-Type: application/json; charset=UTF-8");

header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");

header("Access-Control-Max-Age: 3600");
// Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept
header("Access-Control-Allow-Headers: Origin, Content-Type, Accept,  Access-Control-Allow-Headers, Authorization, X-Requested-With");

function say_something($b){
  if($b){
      echo $b;
  }else{
      echo "Cannot connect database";
  }
  
}

?>