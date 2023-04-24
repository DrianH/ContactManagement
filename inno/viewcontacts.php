<?php
session_start();
if(isset($_SESSION["email"]) && isset($_SESSION["role"])){
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
            <h2>Kontakten verwalten</h2>
            <p> Kontakten anzeigen, bearbeiten, löschen</p>

  <!-- Add the search form -->
    <form method="GET" action="" class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="text" name="search" placeholder="Search contact" aria-label="Search">
        <button class="btn btn-outline-light my-2 my-sm-0 custom-btn" type="submit" style="background-color: rgb(140,177,16); color: white;">Search</button>
    </form>

  <div style="overflow-x: auto;">
      <table>
      <thead>
            <tr>
                <th style="text-align: center; background-color:rgb(140,177,16);" colspan="11" >
                  <strong style="font-size: 25px; color:white; ">Kontakten </strong>
                </th>
            </tr>
                  <tr style="text-align: left;">         
                  <th><strong>ID</strong></th>
                  <th><strong>Name</strong></th>
                  <th><strong>Last Name</strong></th>
                  <th><strong>Birthday</strong></th>
                  <th><strong>E-mail</strong></th>
                  <th><strong>Position</strong></th>
                  <th><strong>Notes</strong></th>
                  <th><strong>Company</strong></th>
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
              $search_query = " WHERE name LIKE '%$search_term%'";
          }

          $select="SELECT * FROM contactperson JOIN company ON companyID=id" . $search_query . ";";
          $tab=$con->query($select);


         //hier zeigen wir alle results die in datenbank gespeichert wurden

          while($row = $tab->fetch_assoc()){
              echo "<tr>";
              echo "<td><em>".$row["id_Contact"]."</em></td>";
              echo "<td><em>".$row["name"]."</em></td>";
              echo "<td><em>".$row["lastName"]."</em></td>";
              echo "<td><em>".$row["birthday"]."</em></td>";
              echo "<td><em>".$row["email"]."</em></td>";
              echo "<td><em>".$row["position"]."</em></td>";
              echo "<td><em>".$row["notes"]."</em></td>";
              echo "<td><em>".$row["Cname"]."</em></td>";
              echo"<td style='text-align:center;'><a href='editcontact.php?id=". $row["id_Contact"] ."'> Edit </a></td>";
              echo"<td style='text-align:center;'><a href='deletecontact.php?id=". $row["id_Contact"] ."'> Delete </a></td>";
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
                <a href="addcontact.php" class="custom-btn"><button style="color:white; background-color:rgb(140,177,16);" class="btn">Add Kontakt</button></a>
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
                            }  
                            else{
                              header("location:index.php");                             
                             }
                            
                                ?>
</html>



        
          
         
     



