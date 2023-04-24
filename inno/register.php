<?php
session_start();
if(isset($_SESSION["email"]) && isset($_SESSION["role"])){
    if($_SESSION["role"] == "Admin"){
?>
<!Doctype html>
<html>
    <head>
    <link href="carousel.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-kFH1rnt0z7Io3xf4JwK0N8FqFjcJ6pajs/rfdfs3SO+kD4Ckdb4G3ATMDlEULwxd" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            border-radius: 12px 12px 0 0;
        }
    </style>
        <?php
        include('header.php');
        include('navbar.php');
        ?> 

    </head>
    
    <?php
    //hier ist die validierung von jeder atttribut gemacht, es wird ein error angezeigt fur verschiedene problemen
    $error=false;
    $erroranrede ="";
    $errorfirstname="";
    $errorlastname="";
    $erroremail="";
    $errorpassword="";
    $errorrepeatpassword="";
    $errorusername ="";
    $errorrole ="";

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        
        if(empty($_POST["anrede"])){
            $error=true;
            $erroranrede="Bitte wählen Sie eine der Alternativen!";
        }

        if(empty($_POST["firstname"])){
            $error=true;
            $errorfirstname="Bitte geben Sie den Namen ein!";
        }

        if(empty($_POST["lastname"])){
            $error=true;
            $errorlastname="Bitte geben Sie den Nachnamen ein!";
        }
        
        if (empty($_POST["email"])) {
            $error=true;
            $erroremail = "Bitte geben Sie die E-Mail ein!";
        }else {
            if(!filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)){
                $error=true;
                $erroremail="Bitte geben Sie die E-Mail korrekt ein!";
            }
        }

        if (empty($_POST["password"])) {
            $error=true;
            $errorrepeatpassword = "Bitte Passwort eingeben!";
        }else {
            if(strlen($_POST["password"])>=8){
                    if(strcmp($_POST['password'],$_POST['pwdconfirm'])!=0){
                        $error=true;
                        $errorpassword="Bitte wiederholen Sie das Passwort!";
                    }
            }else{
                $error=true;
                $errorrepeatpassword="Passwort muss mindestens 8 Zeichen lang sein!";
            }
        }

        if(empty($_POST["username"])){
            $error=true;
            $errorusername="Bitte geben Sie eine Benutzernamen ein!";
        }
        

        
    }
    if(!$error){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            require_once('connection.php');

            $anrede=$_POST["anrede"];
            $firstname=$_POST["firstname"];
            $lastname=$_POST["lastname"];
            $email=$_POST["email"];
            $password=password_hash($_POST["password"],PASSWORD_DEFAULT);
            $username=$_POST["username"];
            $role=$_POST["role"];
            

//hier werden die daten auf der datenbank hinzugefugt
            $sql="INSERT INTO users(anrede, firstname, lastname, email, password, username,  role) values(?,?,?,?,?,?,?);";
            $insert=$con->prepare($sql);
            $insert->bind_param("sssssss", $anrede, $firstname, $lastname, $email, $password, $username, $role);
            $insert->execute();
            $con=null;
            echo "<script>window.location.href='viewuser.php'</script>";
        }
        }
?>

    <br>
    
<body>
<div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
            <form action="register.php" method="POST" class="needs-validation" novalidate>
                    <div class="card">
                    <div style="background-color:rgb(140,177,16);" class="card-header text-white">
                    <h1 class="text-center">User Registration</h1>
                        </div>
        <div class="card-body">
        <div class="row">
        <div class="col-md-6">
            <!--Anrede-->
            <div class="form-group">
            <label for="validationCustom01">Anrede:</label>
            <select class="form-control" id="validationCustom01" name="anrede" required>
                    <option value="" disabled selected>Anrede wählen</option>
                    <option>Frau</option>
                    <option>Herr</option>
                </select>
                <div class="invalid-feedback">
                Bitte wählen Sie eine Anrede!                            
                </div>
                        <?php
                            if(isset($erroranrede)){
                                echo "<p class=\"Rerror\">".$erroranrede."</p>";
                            }
                        ?>
            </div>
            
            <br>

            <!--Vorname-->
            <div class="form-group">
                <label for="validationCustom02">Vorname:</label>
                <input type="text" class="form-control" value="<?PHP if(!empty($_POST["firstname"])){echo $_POST["firstname"];}?>" id="validationCustom02"  placeholder="Vorname" name="firstname" required>
                            <div class="invalid-feedback">
                            Bitte geben Sie den Namen ein!
                            </div>
                        <?php
                            if(isset($errorfirstname)){
                                echo "<p class=\"Rerror\">".$errorfirstname."</p>";
                            }
                        ?>
                        </div>
            <br>

            <!--Nachname-->
            <div class="form-group">
                <label for="validationCustom03">Nachname:</label>
                <input type="text" class="form-control" value="<?PHP if(!empty($_POST["lastname"])){echo $_POST["lastname"];}?>" id="validationCustom02" placeholder="Nachname" name="lastname" required>
                            <div class="invalid-feedback">
                            Bitte geben Sie den Nachnamen ein!
                            </div>
                        <?php
                            if(isset($errorlastname)){
                                echo "<p class=\"Rerror\">".$errorlastname."</p>";
                            }
                        ?>
                        </div>
            <br>  

            <!--E-Mail-Adresse-->
            <div class="form-group" >
                 <label for="validationCustom04">E-Mail-Adresse</label>
                            <input type="email" class="form-control" value="<?PHP if(!empty($_POST["email"])){echo $_POST["email"];}?>" id="validationCustom04" placeholder="Email" name="email" required>
                            <div class="invalid-feedback">
                            Bitte geben Sie die E-Mail ein!                            </div>
                        <?php
                            if(isset($erroremail)){
                                echo "<p class=\"Rerror\">".$erroremail."</p>";
                            }
                        ?>
                        </div>
                        </div>
                        <div class="col-md-6">


            <!--Benutzername-->
            <div class="form-group">
            <label for="validationCustom05">Benutzername:</label>
            <input type="text" class="form-control" value="<?PHP if(!empty($_POST["username"])){echo $_POST["username"];}?>" id="validationCustom05" placeholder="Benutzername" name="username" required>
                <div class="invalid-feedback">
                    Bitte geben Sie den Benutzername ein!
                            </div>
                        <?php
                            if(isset($errorusername)){
                                echo "<p class=\"Rerror\">".$errorusername."</p>";
                            }
                        ?>
                        </div>
            
            <br>
                       

            <!--Password-->
            <div class="form-group">
            <label for="validationCustom06">Password</label>
            <input type="password" class="form-control" value="<?PHP if(!empty($_POST["password"])){echo $_POST["password"];}?>" id="validationCustom06" placeholder="Password" name="password" required>
                <div class="invalid-feedback">
                Bitte Passwort eingeben!                
            </div>
                <?php
                    if(isset($errorrepeatpassword)){
                        echo "<p class=\"Rerror\">".$errorrepeatpassword."</p>";
                    }

                ?>
                </div>
                <br>
            <!--Password Repeat-->
            <div class="form-group">
            <label for="validationCustom07">Password Repeat</label>
            <input type="password" class="form-control" value="<?PHP if(!empty($_POST["pwdconfirm"])){echo $_POST["pwdconfirm"];}?>" id="validationCustom07" placeholder="Password" name="pwdconfirm" required>
                <div class="invalid-feedback">
                    Bitte wiederholen Sie das Passwort!
                 </div>
                    <?php
                        if(isset($errorpassword)){
                            echo "<p class=\"Rerror\">".$errorpassword."</p>";
                        }
                        ?>
            </div>


            
            <br>
        <label for="validationCustom01">Role:</label>
        <select class="form-control" id="validationCustom01" name="role" required>
            <option>Admin</option>
            <option>Employee</option>
        </select>
    </br>
</br>
                    </div>
                    </div>
            <!--Submit Button-->
            <div class="d-grid gap-2 mt-3">
                                <input type="submit" style="color:white; background-color:rgb(140,177,16); border: 4px solid rgb(140,177,16);" name="submit" value="Submit">
                            </div>
                </div>
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
                            }  }
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

