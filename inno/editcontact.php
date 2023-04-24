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
            $id_Contact=$_POST["id"];


//hier machen wir eine update statement um die daten in datenbank zu aktualisieren
            $sql="UPDATE contactperson SET name = ?, lastName = ?, birthday = ?, email = ?, position = ?, notes = ?, companyID = ? WHERE id_Contact = ?;";
            $insert=$con->prepare($sql);
            $insert->bind_param("ssssssii", $name, $lastName, $new_bday, $email, $position, $notes, $companyID, $id_Contact);
            $insert->execute();
            $con=null;
            echo "<script>window.location.href='viewcontacts.php'</script>";
            }
                require_once "connection.php";
        //hier sind die daten selektiert und diese werden beim formular angezeigt
        $sql2 = "SELECT * FROM contactperson WHERE id_Contact = ?";
        $stmt = $con->prepare("SELECT * FROM contactperson WHERE id_Contact = ?");
        $stmt->bind_param("i", $_GET["id"]);
        $stmt->execute();
        $res = $stmt->get_result();
        $row = $res->fetch_assoc();
            
        

        
    }
?>

    <br>
    
<body>
<div class="container col-6">
    <form action="editcontact.php" method="POST" class="needs-validation" novalidate>            
        <div>
                <h1 class="text-center text-muted ">Edit Contact</h1>
            </div>
            
            <br>

            <!--Vorname-->
            <div class="form-group">
                <input type="text" value="<?php echo $_GET["id"]; ?>" name="id" hidden>
                <label for="validationCustom02">Vorname:</label>
                <input type="text" class="form-control" value="<?PHP echo $row["name"];?>" id="validationCustom02"  placeholder="Vorname" name="name" required>
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
                <input type="text" class="form-control" value="<?PHP echo $row["lastName"];?>" id="validationCustom02" placeholder="Nachname" name="lastName" required>
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
                <input type="date" class="form-control" value="<?PHP echo $row["birthday"];?>" id="validationCustom02" placeholder="Geburtsdatum" name="birthday" required>
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
                            <input type="email" class="form-control" value="<?PHP echo $row["email"];?>" id="validationCustom04" placeholder="Email" name="email" required>
                            <div class="invalid-feedback">
                            Bitte geben Sie die E-Mail ein!                            </div>
                        <?php
                            if(isset($erroremail)){
                                echo "<p class=\"Rerror\">".$erroremail."</p>";
                            }
                        ?>
                        </div>

                        <br>

            <!--Benutzername-->
            <div class="form-group">
            <label for="validationCustom05">Position:</label>
            <input type="text" class="form-control" value="<?PHP echo $row["position"];?>" id="validationCustom05" placeholder="Position" name="position" required>
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
            <input type="text" class="form-control" value="<?PHP echo $row["notes"];?>" id="validationCustom05" placeholder="Notes" name="notes" required>
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

            <br>
        
</br>
            <!--Submit Button-->
            <div class="d-grid gap-2">
                <input type="submit" style="color:white; background-color:rgb(140,177,16); border: 4px solid rgb(140,177,16);" name="submit" value="Submit"><br>
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


