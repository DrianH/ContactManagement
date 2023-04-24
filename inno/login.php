<?php
session_start();

    $erroremail="";
    $errorpwd="";

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        include_once "connection.php"; 
        $email=$_POST["email"]; 
        $password=$_POST["password"];
//selektieren wir die daten von tabelle users in datenbank um die login zu machen
        $sql = "SELECT id_users, username, password, role FROM users WHERE email = ?";
        $stmt=$con->prepare($sql); 
        $stmt->bind_param("s", $email);
        $stmt->execute(); 

        $result = $stmt->get_result();
        //hier wird der session gespeichert 
        while($row = $result->fetch_assoc()){
            if(password_verify($password, $row["password"])) { 
                $username = $row["username"]; 
                $userRolle = $row["role"]; 
                $userId = $row["id_users"]; 

                $_SESSION["username"] = $username;
                $_SESSION["email"] = $email; 
                $_SESSION["role"] = $userRolle; 
                $_SESSION["userId"] = $userId;

                header("location:index.php");
                exit(); 
            }else{ 
                $errorpwd="Wrong password. Please try again!";
            }
        }
        $con = null; 
    }
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


    <br>
    <br>
    <br>

    <body>
    <div class="container col">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="sign-in-form">
    <div>
                <h1 class="text-center text-muted ">User Login</h1>
            </div>
            <br>
    
        <div class="form-group mb-3">
            <label>E-mail:</label>
            <input type="email" class="form-control" id="email" value="<?PHP if(!empty($_POST["email"])){echo $_POST["email"];}?>" placeholder="E-mail" name="email" required>
            <?php
                            if(isset($erroremail)){
                                echo "<p class=\"Rerror\">".$erroremail."</p>";
                            }
                        ?>
        </div>
       
        <div class="form-group mb-3">
            <label>Password:</label>
            <input type="password" class="form-control" id="password" value="<?PHP if(!empty($_POST["password"])){echo $_POST["password"];}?>" placeholder="Password" name="password" required>
            <?php
                            if(isset($errorpwd)){
                                echo "<p class=\"Rerror\">".$errorpwd."</p>";
                            }
                        ?>
        </div>
       
        <div class="form-group form-check mb-3">
            <label class="form-check-label mb-3">
                <input type="checkbox" class="form-check-input"> Remember me
            </label>
            <a style="color:rgb(140,177,16)" href="#" class="float-end">Forgot your password?</a>
        </div>
        <div class="d-grid gap-2">
        <button type="submit" name="submit" style="color:white; background-color:rgb(140,177,16); border: 4px solid rgb(140,177,16);">Log In</button>
        </div>
</div>
        
    </form>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

    <?php

    include('footer.php');
    ?>
</body>
</html>