<?php
session_start();
if(isset($_SESSION["email"]) && isset($_SESSION["role"])){
  if($_SESSION["role"] == "Admin"){
?>
<!Doctype html>
<html lang="en">
    <head>
    <link href="carousel.css" rel="stylesheet">
    <link href="css/hovereffect.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <?php
        include('header.php');
        include('navbar.php');
        ?>      
    </head>

  <body>
  <main id="main">
  <div style="max-width:80%; margin-left:auto; margin-right:auto;">
    
    <br>
            <h2>Benutzer verwalten</h2>
            <p>Benutzer anzeigen, bearbeiten, löschen</p>

                <!-- Add the search form -->
        <form method="GET" action="" class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="text" name="search" placeholder="Search user" aria-label="Search">
        <button class="btn btn-outline-light my-2 my-sm-0 custom-btn" type="submit" style="background-color: rgb(140,177,16); color: white;">Search</button>
        </form>
      
  <div style="overflow-x: auto;">
      <table>
      <thead>
            <tr>
                <th style="text-align: center; background-color:rgb(140,177,16);" colspan="10" >
                  <strong style="font-size: 25px; color:white;">Benutzers </strong>
                </th>
            </tr>
                  <tr style="text-align: left;">         
                  <th><strong>ID</strong></th>
                  <th><strong>Anrede</strong></th>
                  <th><strong>Vorname</strong></th>
                  <th><strong>Nachname</strong></th>
                  <th><strong>E-Mail</strong></th>
                  <th><strong>Benutzername</strong></th>
                  <th><strong>Role</strong></th>
                  <th style="text-align: center;"><strong>EDIT</strong></th>
                  <th style="text-align: center;"><strong>DELETE</strong></th>
              </tr>
          </thead>
          <tbody>
          <?php
          require_once("connection.php");
          //hier selektieren wir alle daten von tabelle users von datenbank
          
          // Define the search query if search input is provided
          $search_query = "";
          if (isset($_GET['search']) && !empty($_GET['search'])) {
            $search_term = mysqli_real_escape_string($con, $_GET['search']);
            $search_query = " WHERE firstname LIKE '%$search_term%' OR lastname LIKE '%$search_term%'";
        }
          $select="SELECT id_users,anrede,firstname,lastname,email,username,password,role FROM users ORDER BY id_users ";
          $tab=$con->query($select);

          $select="SELECT id_users, anrede, firstname, lastname, email, username, password, role FROM users" . $search_query . " ORDER BY id_users";
          $tab=$con->query($select);


         //hier zeigen wir alle results die in datenbank gespeichert wurden

          while($row = $tab->fetch_assoc()){
              echo "<tr>";
              echo "<td><em>".$row["id_users"]."</em></td>";
              echo "<td><em>".$row["anrede"]."</em></td>";
              echo "<td><em>".$row["firstname"]."</em></td>";
              echo "<td><em>".$row["lastname"]."</em></td>";
              echo "<td><em>".$row["email"]."</em></td>";
              echo "<td><em>".$row["username"]."</em></td>";
              echo "<td><em>".$row["role"]."</em></td>";
              echo"<td style='text-align:center;'><a href='edituser.php?id=". $row["id_users"] ."'> Edit </a></td>";
              echo"<td style='text-align:center;'><a href='deleteuser.php?id=". $row["id_users"] ."'> Delete </a></td>";
              echo "</tr>";

              $con= null;
          }

          ?>
      </tbody>
      </table>
    </div>
    <br>
    <div class="form-horisontal">
                <div class="col-sm-6 row">
                <a href="register.php" class="custom-btn"><button style="color:white; background-color:rgb(140,177,16);" class="btn ">Add User</button></a>
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

    <script src="../js/bootstrap.bundle.min.js"></script>

</main>
  </body>
  <?php
                            }  }
                            else{
                              header("location:index.php");                             
                             }
                            
                                ?>
</html>



        
          
         
     



