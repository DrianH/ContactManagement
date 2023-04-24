<?php
session_start();
if(isset($_SESSION["email"]) && isset($_SESSION["role"])){
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
    $errorCname ="";
    $errorsize="";
    $errorindustry="";
    $errorlocation="";
    $errorphoneNumber="";
    $erroremail="";
    $errornotes ="";
    $errorURL ="";

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        
        if(empty($_POST["Cname"])){
            $error=true;
            $errorCname="Bitte geben Sie den Namen ein!";
        }

        if(empty($_POST["size"])){
            $error=true;
            $errorsize="Bitte geben Sie den Size ein!";
        }

        if(empty($_POST["industry"])){
            $error=true;
            $errorindustry="Bitte geben Sie den Industrie ein!";
        }
        if(empty($_POST["location"])){
            $error=true;
            $errorlocation="Bitte geben Sie den Location ein!";
        }
        if(empty($_POST["phoneNumber"])){
            $error=true;
            $errorphoneNumber="Bitte geben Sie den Industrie ein!";
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

        if(empty($_POST["notes"])){
            $error=true;
            $errornotes="Bitte Schreiben Sie den Notes ein!";
        }
        if(empty($_POST["URL"])){
            $error=true;
            $errorURL="Bitte Schreiben Sie den URL ein!";
        }
    }
    if(!$error){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            require_once('connection.php');

            $Cname=$_POST["Cname"];
            $size=$_POST["size"];
            $industry=$_POST["industry"];
            $location=$_POST["location"];
            $phoneNumber=$_POST["phoneNumber"];
            $email=$_POST["email"];
            $notes=$_POST["notes"];
            $URL=$_POST["URL"];
            

//hier werden die daten auf der datenbank hinzugefugt
            $sql="INSERT INTO company(Cname, size, industry, location, phoneNumber, email,  notes, URL) values(?,?,?,?,?,?,?,?);";
            $insert=$con->prepare($sql);
            $insert->bind_param("sissssss", $Cname, $size, $industry, $location, $phoneNumber, $email, $notes, $URL);
            $insert->execute();
            $con=null;
            echo "<script>window.location.href='viewcompany.php'</script>";
        }
        }
?>

    <br>
    
<body>
<div class="container my-5">
    <div class="row justify-content-center">
    <div class="col-md-10">
        <form action="addcompany.php" method="POST" class="needs-validation" novalidate>            
        <div class="card">
                <div style="background-color:rgb(140,177,16);" class="card-header text-white">
                    <h1 class="text-center">Company Registration</h1>
                </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">

            <div class="form-group">
                <label for="validationCustom02">Name:</label>
                <input type="text" class="form-control" value="<?PHP if(!empty($_POST["Cname"])){echo $_POST["Cname"];}?>" id="validationCustom02"  placeholder="Name" name="Cname" required>
                            <div class="invalid-feedback">
                            Bitte geben Sie den Namen ein!
                            </div>
                        <?php
                            if(isset($errorCname)){
                                echo "<p class=\"Rerror\">".$errorCname."</p>";
                            }
                        ?>
                        </div>
            <br>

            <div class="form-group">
                <label for="validationCustom03">Size:</label>
                <input type="text" class="form-control" value="<?PHP if(!empty($_POST["size"])){echo $_POST["size"];}?>" id="validationCustom02" placeholder="Size" name="size" required>
                            <div class="invalid-feedback">
                            Bitte geben Sie den Size ein!
                            </div>
                        <?php
                            if(isset($errorsize)){
                                echo "<p class=\"Rerror\">".$errorsize."</p>";
                            }
                        ?>
                        </div>
            <br>  


             <div class="form-group">
                <label for="validationCustom03">Industry:</label>
                <input type="text" class="form-control" value="<?PHP if(!empty($_POST["industry"])){echo $_POST["industry"];}?>" id="validationCustom02" placeholder="Industry" name="industry" required>
                            <div class="invalid-feedback">
                            Bitte geben Sie den Industrie ein!
                            </div>
                        <?php
                            if(isset($errorindustry)){
                                echo "<p class=\"Rerror\">".$errorindustry."</p>";
                            }
                        ?>
                        </div>
<br>

                        
            <div class="form-group">
                <label for="validationCustom03">Location:</label>
                <input type="text" class="form-control" value="<?PHP if(!empty($_POST["location"])){echo $_POST["location"];}?>" id="validationCustom02" placeholder="Location" name="location" required>
                            <div class="invalid-feedback">
                            Bitte geben Sie den Location ein!
                            </div>
                        <?php
                            if(isset($errorindustry)){
                                echo "<p class=\"Rerror\">".$errorlocation."</p>";
                            }
                        ?>
                        </div>
                        </div>
                        <div class="col-md-6">
            <div class="form-group">
                <label for="validationCustom03">Phone Number:</label>
                <input type="text" class="form-control" value="<?PHP if(!empty($_POST["phoneNumber"])){echo $_POST["phoneNumber"];}?>" id="validationCustom02" placeholder="Phone Number" name="phoneNumber" required>
                            <div class="invalid-feedback">
                            Bitte geben Sie den Telefonnummer ein!
                            </div>
                        <?php
                            if(isset($errorphoneNumber)){
                                echo "<p class=\"Rerror\">".$errorphoneNumber."</p>";
                            }
                        ?>
                        </div>

<br>

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

                        <br>

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

            <div class="form-group">
            <label for="validationCustom05">URL:</label>
            <input type="text" class="form-control" value="<?PHP if(!empty($_POST["URL"])){echo $_POST["URL"];}?>" id="validationCustom05" placeholder="URL" name="URL" required>
                <div class="invalid-feedback">
                    Bitte geben Sie den URL ein!
                            </div>
                        <?php
                            if(isset($errorURL)){
                                echo "<p class=\"Rerror\">".$errorURL."</p>";
                            }
                        ?>
                        </div>


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

