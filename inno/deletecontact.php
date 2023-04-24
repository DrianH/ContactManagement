<?php
session_start();
if(isset($_SESSION["email"]) && isset($_SESSION["role"])){

require_once "connection.php";
$stmt = $con->prepare("DELETE FROM contactperson WHERE id_Contact =  ?");
$stmt->bind_param("i", $_GET["id"]);
$stmt->execute();
header("Location:viewcontacts.php");

}  
else{
  header("location:index.php");                             
 }

?>


