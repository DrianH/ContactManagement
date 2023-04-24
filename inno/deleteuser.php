<?php
session_start();
if(isset($_SESSION["email"]) && isset($_SESSION["role"])){
  if($_SESSION["role"] == "Admin"){

    require_once "connection.php";
// hier machen wir eine delete statement um die daten die in datenbank gespeichert sind zu loschen
$stmt = $con->prepare("delete from users where id_users = ?");
$stmt->bind_param("i", $_GET["id"]);
$stmt->execute();
header("Location:viewuser.php");

}  }
else{
  header("location:index.php");                             
 }

?>