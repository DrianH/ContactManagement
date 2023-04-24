<?php
session_start();
if(isset($_SESSION["email"]) && isset($_SESSION["role"])){
?>
<!Doctype html>
<html>
    <head>
    <link href="carousel.css" rel="stylesheet">

        <?php
        include('header.php');
        include('navbar.php');
        ?> 

    </head>
    
    <?php
    //hier ist die validerung von jeder attribut gemacht
    $error=false;
    $erroroldpass="";
    $errornewpass="";
    $errorrepeatnewpass="";

    require_once "connection.php";
    $pwdsql="SELECT password FROM users WHERE email = ?";
    $pwdstmt=$con->prepare($pwdsql); 
    $pwdstmt->bind_param("s", $_SESSION["email"]);
    $pwdstmt->execute();
    $pwdres=$pwdstmt->get_result();
    $pwdrow=$pwdres->fetch_assoc();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
          
        if(empty($_POST["oldpass"])){
            $error=true;
            $oldpass="Bitte geben Sie das alte Passwort ein!";
        }

        if(!password_verify($_POST["oldpass"], $pwdrow["password"])){
            $error=true;
            $oldpass="Altes Passwort ist falsch!";
        }
      
        if(empty($_POST["newpass"])){
            $error=true;
            $errorfirstname="Bitte geben Sie das neue Passwort ein!";
        }

        if(empty($_POST["repeatnewpass"])){
            $error=true;
            $errorlastname="Bitte geben Sie das neue Passwort erneut ein!";
        }

        if($_POST["newpass"] != $_POST["repeatnewpass"]){
            $error=true;
            $errorlastname="Neue Passw\$ouml;rter stimmen nicht \$uuml;berein!";
        }
    }
    
    if(!$error){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            require_once('connection.php');

            $newpass=password_hash($_POST["newpass"],PASSWORD_DEFAULT);;

//hier machen wir eine update statement um die daten in datenbank zu aktualisieren
            $sql="UPDATE users SET password = ? WHERE email=?;";
            $insert=$con->prepare($sql);
            $insert->bind_param("ss", password_hash($_POST["newpass"], PASSWORD_DEFAULT), $_SESSION["email"]);
            $insert->execute();
            $con=null;
            echo "<script>window.location.href='viewuser.php'</script>";
            }
    }
?>

    <br>
    
<body>
    <div class="container col-6">
    <form action="changepassword.php" method="POST" class="needs-validation" novalidate>            
        <div>  
                <h1 class="text-center text-muted ">Change Password</h1>
            </div>
            
            <br>
            <div class="form-group">
                <label for="validationCustom02">Altes Passwort:</label>
                <input type="password" class="form-control" id="validationCustom02" name="oldpass" required>
                            <div class="invalid-feedback">
                            Bitte geben Sie das neue Passwort ein!
                            </div>
                        <?php
                            if(isset($erroroldpass)){
                                echo "<p class=\"Rerror\">".$erroroldpass."</p>";
                            }
                        ?>
                        </div>
            <br>

            <div class="form-group">
                <label for="validationCustom02">Neues Passwort:</label>
                <input type="password" class="form-control" id="validationCustom02" name="newpass" required>
                            <div class="invalid-feedback">
                            Bitte geben Sie das neue Passwort ein!
                            </div>
                        <?php
                            if(isset($errornewpass)){
                                echo "<p class=\"Rerror\">".$errornewpass."</p>";
                            }
                        ?>
                        </div>
            <br>

            <div class="form-group">
                <label for="validationCustom03">Wiederholen Neues Passwort:</label>
                <input type="password" class="form-control" id="validationCustom02" name="repeatnewpass" required>
                            <div class="invalid-feedback">
                            Bitte geben Sie das neue Passwort erneut ein!
                            </div>
                        <?php
                            if(isset($errorrepeatnewpass)){
                                echo "<p class=\"Rerror\">".$errorrepeatnewpass."</p>";
                            }
                        ?>
                        </div>
            <br>  
        <br>
                                </br>
            <!--Submit Button-->
            <div class="d-grid gap-2">
                <input type="submit" class="btn btn-warning btn-regular" name="submit" value="Submit"><br>
            </div>
    
        </form>
    </div>
                        </div>
                        </div>

<br>
<br>
<br>
<br>

    <?php

    include('footer.php');
    ?>
</body>
<?php
}  
else{
  header("location:index.php");                             
 }
?>
</html>

<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>