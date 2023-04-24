<?php
session_start();
if(isset($_SESSION["email"]) && isset($_SESSION["role"])){

    require_once "connection.php";
// hier machen wir eine delete statement um die daten die in datenbank gespeichert sind zu loschen
$stmt = $con->prepare("DELETE FROM company WHERE id = ?");
$stmt->bind_param("i", $_GET["id"]);
$stmt->execute();
header("Location:viewcompany.php");

}  
else{
  header("location:index.php");                             
 }

?>