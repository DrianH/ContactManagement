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
    $erroranrede="";
    $errorfirstname="";
    $errorlastname="";
    $erroremail="";
    $errorusername ="";
    $errorrole ="";

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
          
        if(empty($_POST["anrede"])){
            $error=true;
            $errorfirstname="Bitte geben Sie den Anrede ein!";
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

        if(empty($_POST["username"])){
            $error=true;
            $errorusername="Bitte geben Sie eine Benutzernamen ein!";
        }
        if(empty($_POST["role"])){
            $error=true;
            $errorusername="Bitte geben Sie eine Role ein!";
        }
    }
    
    if(!$error){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            require_once('connection.php');

            $anrede=$_POST["anrede"];
            $firstname=$_POST["firstname"];
            $lastname=$_POST["lastname"];
            $email=$_POST["email"];
            $username=$_POST["username"];
            $role=$_POST["role"];
            $id=$_POST["id"];

//hier machen wir eine update statement um die daten in datenbank zu aktualisieren
            $sql="UPDATE users SET anrede = ?, firstname = ?, lastname = ?, email = ?, username = ?, role = ? WHERE id_users=?;";
            $insert=$con->prepare($sql);
            $insert->bind_param("ssssssi",$anrede, $firstname, $lastname, $email, $username, $role, $id);
            $insert->execute();
            $con=null;
            echo "<script>window.location.href='viewuser.php'</script>";
            }
        require_once "connection.php";
        //hier sind die daten selektiert und diese werden beim formular angezeigt
        $sql2 = "SELECT * FROM users WHERE id_users = ?";
        $stmt = $con->prepare("SELECT * FROM users WHERE id_users = ?");
        $stmt->bind_param("i", $_GET["id"]);
        $stmt->execute();
        $res = $stmt->get_result();
        $row = $res->fetch_assoc();
        
            
        

        
    }
?>

    <br>
    
<body>
    <div class="container col-6">
    <form action="edituser.php" method="POST" class="needs-validation" novalidate>            
        <div>  
                <h1 class="text-center text-muted ">Edit Users</h1>
            </div>
            
            <br>    
            <!--Anrede-->
            <div class="form-group">
            <input type="text" value="<?php echo $_GET["id"]; ?>" name="id" hidden>

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

            <div class="form-group">
                <label for="validationCustom02">Vorname:</label>
                <input type="text" class="form-control" id="validationCustom02"  value="<?php echo $row["firstname"]; ?>" name="firstname" required>
                            <div class="invalid-feedback">
                            Bitte geben Sie den Namen ein!
                            </div>
                        <?php
                            if(isset($firstname)){
                                echo "<p class=\"Rerror\">".$firstname."</p>";
                            }
                        ?>
                        </div>
            <br>

            <div class="form-group">
                <label for="validationCustom03">Nachname:</label>
                <input type="text" class="form-control" id="validationCustom02" value="<?php echo $row["lastname"]; ?>" name="lastname" required>
                            <div class="invalid-feedback">
                            Bitte geben Sie den Nachname ein!
                            </div>
                        <?php
                            if(isset($errorlastname)){
                                echo "<p class=\"Rerror\">".$errorlastname."</p>";
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

            <div class="form-group" >
                 <label for="validationCustom04">Username:</label>
                            <input type="text" class="form-control" id="validationCustom04" value="<?php echo $row["username"]; ?>" name="username" required>
                            <div class="invalid-feedback">
                            Bitte geben Sie den Username ein!
                                           </div>
                        <?php
                            if(isset($errorusername)){
                                echo "<p class=\"Rerror\">".$errorusername."</p>";
                            }
                        ?>
                        </div>
                        <br>
                        <label for="validationCustom01">Role:</label>
                    <select class="form-control" id="validationCustom01" name="role" required>
                        <?php
                                    echo "<option>".$row['role']."</option>";
                                    if ($row['role'] == 'Admin'){
                                        echo "<option>Employee</option>";
                                    }  
                                    else if ($row['role'] == 'Employee'){
                                        echo "<option>Admin</option>";
                                    }               
                                        ?>
        </select>
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


