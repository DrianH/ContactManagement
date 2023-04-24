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
            $erroranrede="Bitte geben Sie den Namen ein!";
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
            $id=$_POST["id"];
//hier machen wir eine update statement um die daten in datenbank zu aktualisieren
            $sql="UPDATE company SET Cname = ?, size = ?, industry = ?, location = ?, phoneNumber = ?, email = ?, notes = ?, URL = ? WHERE id=? ;";
            $insert=$con->prepare($sql);
            $insert->bind_param("sissssssi", $Cname, $size, $industry, $location, $phoneNumber, $email, $notes, $URL, $id);
            $insert->execute();
            $con=null;
            echo "<script>window.location.href='viewcompany.php'</script>";
            }
                require_once "connection.php";
        //hier sind die daten selektiert und diese werden beim formular angezeigt
        $sql2 = "SELECT * FROM company WHERE id = ?";
        $stmt = $con->prepare("SELECT * FROM company WHERE id = ?");
        $stmt->bind_param("i", $_GET["id"]);
        $stmt->execute();
        $res = $stmt->get_result();
        $row = $res->fetch_assoc();
            
        

        
    }
?>

    <br>
    
<body>
    <div class="container col-6">
    <form action="editunternehmen.php" method="POST" class="needs-validation" novalidate>            
        <div>
                <h1 class="text-center text-muted ">Edit Unternehmen</h1>
            </div>
            
            <br>

            <div class="form-group">
                <input value="<?php echo $_GET["id"];?>" name="id" hidden>
                <label for="validationCustom02">Name:</label>
                <input type="text" class="form-control" id="validationCustom02"  value="<?php echo $row["Cname"]; ?>" name="Cname" required>
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
                <input type="text" class="form-control" id="validationCustom02" value="<?php echo $row["size"]; ?>" name="size" required>
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

            <div class="form-group" >
                 <label for="validationCustom04">Industry:</label>
                            <input type="text" class="form-control" id="validationCustom04" value="<?php echo $row["industry"]; ?>" name="industry" required>
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
            <label for="validationCustom05">Location:</label>
            <input type="text" class="form-control" id="validationCustom05" value="<?php echo $row["location"]; ?>" name="location" required>
                <div class="invalid-feedback">
                Bitte geben Sie den Location ein!
                            </div>
                        <?php
                            if(isset($errorlocation)){
                                echo "<p class=\"Rerror\">".$errorlocation."</p>";
                            }
                        ?>
                        </div>
            
            <br>

            <!--Ort-->
            <div class="form-group">
            <label for="validationCustom08">Phone Number:</label>
            <input type="text" class="form-control" id="validationCustom08" value="<?php echo $row["phoneNumber"]; ?>" name="phoneNumber" required>
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

            <div class="form-group">
            <label for="validationCustom08">E-Mail-Adresse:</label>
            <input type="text" class="form-control" id="validationCustom08" value="<?php echo $row["email"]; ?>" name="email" required>
                <div class="invalid-feedback">
                Bitte geben Sie die E-Mail ein!  
                            </div>
                        <?php
                            if(isset($erroremail)){
                                echo "<p class=\"Rerror\">".$erroremail."</p>";
                            }
                        ?>
                        </div>

                        <br>

            <div class="form-group">
            <label for="validationCustom08">Notes:</label>
            <input type="text" class="form-control" id="validationCustom08" value="<?php echo $row["notes"]; ?>" name="notes" required>
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
            <label for="validationCustom08">URL:</label>
            <input type="text" class="form-control" id="validationCustom08" value="<?php echo $row["URL"]; ?>" name="URL" required>
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


