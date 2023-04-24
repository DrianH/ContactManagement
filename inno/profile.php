<?php
session_start();
if(isset($_SESSION["email"]) && isset($_SESSION["role"])){
?>
<!Doctype html>
<html lang="en">
    <head>
    <link href="carousel.css" rel="stylesheet">
    <link href="css/hovereffect.css" rel="stylesheet" type="text/css" />

        <?php
        include('header.php');
        include('navbar.php');
        include('connection.php');
//selektieren wir die daten von spezifischen user  der mit session eingeloggt ist 
        $sql = "select * from users where email = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("s", $_SESSION["email"]);
        $stmt->execute();

        $res = $stmt->get_result();
        $row = $res->fetch_assoc();
        ?>      
    </head>

  <body>
  <main id="main">

  <br>
    <br>
    <br>
    
                <h1>
                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            
                My Profile
                </h1>
                <br>
                <br>

                        <!--a href='editprofile.php?id=<?php// echo $row["id_users"]?>' class='btn btn-warning'>Edit</a-->
                  



    <section style="background-color: #eee;">
  <div class="container py-5">
    
    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            <img src="images/Profile.jpg" alt="avatar"
              class="rounded-circle img-fluid" style="width: 150px;">
            <h5 class="my-3"><?php echo "<tr><td>".$row["firstname"]."</td></tr>";?></h5>
            <p class="text-muted mb-1">FH Technikum Wien</p>
            <p class="text-muted mb-4"><?php echo "<tr><td>".$row["role"]."</td></tr>";?></p>
            
          </div>
        </div>
        
      </div>
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">First Name</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo "<tr><td>".$row["firstname"]."</td></tr>";?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Last Name</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo "<tr><td>".$row["lastname"]."</td></tr>";?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Username</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo "<tr><td>".$row["username"]."</td></tr>";?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">E-mail</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo "<tr><td>".$row["email"]."</td></tr>";?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Role</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo "<tr><td>".$row["role"]."</td></tr>";?></p>
              </div>
            </div>
          </div>
        </div>
        <div class="d-flex justify-content-center mb-2">

        <a href="editprofile.php" type="button" class="btn btn-outline-primary ms-1">Edit</a>

              &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp



              <a href="changepassword.php" type="button" class="btn btn-outline-primary ms-1">Change Password</a>
              &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
              <a href="logout.php" type="button" class="btn btn-outline-primary ms-1">Logout</a>
            </div>
      </div>
    </div>
  </div>
</section>
<br>
<br>
<br>
<br>

 <?php
include('footer.php');
 ?>

    <script src="../js/bootstrap.bundle.min.js"></script>

</main>
  </body>
  <?php
                              }
                            else{
                              header("location:index.php");                             
                             }
                            
                                ?>
</html>