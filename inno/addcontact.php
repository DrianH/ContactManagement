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
    $errorname="";
    $errorlastName="";
    $errorbirthday="";
    $erroremail="";
    $errorposition="";
    $errornotes="";
    $errorusername ="";
    $errorcompanyID  ="";


    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        
        if(empty($_POST["name"])){
            $error=true;
            $errorname="Bitte geben Sie den Namen ein!";
        }

        if(empty($_POST["lastName"])){
            $error=true;
            $errorlastname="Bitte geben Sie den Nachnamen ein!";
        }
        
        if(empty($_POST["birthday"])){
            $error=true;
            $errorbirthday="Bitte geben Sie eine Birthday ein!";
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
        if(empty($_POST["position"])){
            $error=true;
            $errorusername="Bitte geben Sie eine Position ein!";
        }


        if(empty($_POST["notes"])){
            $error=true;
            $errornotes="Bitte geben Sie einpaar Notizien ein!";
        }


    if(empty($_POST["companyID"])){
            $error=true;
            $errorcompanyID ="Bitte wählen Sie eine der Alternativen!";
        }
        

        
    }
    if(!$error){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            require_once('connection.php');

            $name=$_POST["name"];
            $lastName=$_POST["lastName"];
            $birthday=$_POST["birthday"];
            $new_bday = date("Y-m-d", strtotime($birthday));
            $email=$_POST["email"];
            $position=$_POST["position"];
            $notes=$_POST["notes"];
            $companyID=$_POST["companyID"];

            

//hier werden die daten auf der datenbank hinzugefugt
            $sql="INSERT INTO contactperson(name, lastName, birthday, email, position, notes,  companyID ) values(?,?,?,?,?,?,?);";
            $insert=$con->prepare($sql);
            $insert->bind_param("ssssssi", $name, $lastName, $new_bday, $email, $position, $notes, $companyID );
            $insert->execute();
            $con=null;
            echo "<script>window.location.href='viewcontacts.php'</script>";
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
                <h1 class="text-center">Contacts Registration</h1>
                     </div>
            
        <div class="card-body">
        <div class="row">
        <div class="col-md-6">
            <!--Vorname-->
            <div class="form-group">
                <label for="validationCustom02">Vorname:</label>
                <input type="text" class="form-control" value="<?PHP if(!empty($_POST["name"])){echo $_POST["name"];}?>" id="validationCustom02"  placeholder="Vorname" name="name" required>
                            <div class="invalid-feedback">
                            Bitte geben Sie den Namen ein!
                            </div>
                        <?php
                            if(isset($errorname)){
                                echo "<p class=\"Rerror\">".$errorname."</p>";
                            }
                        ?>
                        </div>
            <br>

            <!--Nachname-->
            <div class="form-group">
                <label for="validationCustom03">Nachname:</label>
                <input type="text" class="form-control" value="<?PHP if(!empty($_POST["lastName"])){echo $_POST["lastName"];}?>" id="validationCustom02" placeholder="Nachname" name="lastName" required>
                            <div class="invalid-feedback">
                            Bitte geben Sie den Nachnamen ein!
                            </div>
                        <?php
                            if(isset($errorlastName)){
                                echo "<p class=\"Rerror\">".$errorlastName."</p>";
                            }
                        ?>
                        </div>
            <br>  

            <!--Birthday-->
            <div class="form-group">
                <label for="validationCustom03">Birthday:</label>
                <input type="date" class="form-control" value="<?PHP if(!empty($_POST["birthday"])){echo $_POST["birthday"];}?>" id="validationCustom02" placeholder="Geburtsdatum" name="birthday" required>
                            <div class="invalid-feedback">
                            Bitte geben Sie den Geburtsdatum ein!
                            </div>
                        <?php
                            if(isset($errorbirthday)){
                                echo "<p class=\"Rerror\">".$errorbirthday."</p>";
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
            <label for="validationCustom05">Position:</label>
            <input type="text" class="form-control" value="<?PHP if(!empty($_POST["position"])){echo $_POST["position"];}?>" id="validationCustom05" placeholder="Position" name="position" required>
                <div class="invalid-feedback">
                    Bitte geben Sie den Position ein!
                            </div>
                        <?php
                            if(isset($errorposition)){
                                echo "<p class=\"Rerror\">".$errorposition."</p>";
                            }
                        ?>
                        </div>
            
            <br>
 <!--Benutzername-->
 <div class="form-group">
            <label for="validationCustom05">Notes:</label>
            <input type="text" class="form-control" value="<?PHP if(!empty($_POST["notes"])){echo $_POST["notes"];}?>" id="validationCustom05" placeholder="Notes" name="notes" required>
                <div class="invalid-feedback">
                    Bitte geben Sie den Notes ein!
                            </div>
                        <?php
                            if(isset($errornotes)){
                                echo "<p class=\"Rerror\">".$errornotes."</p>";
                            }
                        ?>
                        </div>
            
        <br>
                <!--Unternehmen-->
                <div class="form-group">
                            <label for="validationCustom01">Unternehmen:</label>
                            <select class="form-control" id="validationCustom01" name="companyID" required>
                                    <option value="" disabled selected>Unternehmen wählen</option>
                                        <?php 
                                    require_once("connection.php");
                                    $result = $con->query("SELECT id, Cname FROM company ");

                                    foreach($result as $row){
                                    echo "<option value=".$row['id'].">".$row['Cname']."</option>";
                                            }
                                        ?>
                            </select>
                                <div class="invalid-feedback">
                                Bitte wählen Sie eine Unternehmen!                            
                                </div>
                                        <?php
                                            if(isset($error)){
                                                echo "<p class=\"Rerror\">".$errorcompanyID."</p>";
                                            }
                                        ?>
                        </div>

                                                    <br></br>

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

