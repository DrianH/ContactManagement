<?php
session_start();
if(isset($_SESSION["email"]) && isset($_SESSION["role"])){
?>
<!Doctype html>
<html lang="en">
    <head>
    <link href="carousel.css" rel="stylesheet">
    <link href="css/hovereffect.css" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
            <h2>Unternehmen verwalten</h2>
            <p>Unternehmen anzeigen, bearbeiten, löschen</p>

   <!-- Add the search form -->
   <form method="GET" action="" class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="text" name="search" placeholder="Search company" aria-label="Search">
        <button class="btn btn-outline-light my-2 my-sm-0 custom-btn" type="submit" style="background-color: rgb(140,177,16); color: white;">Search</button>
    </form>
      
  <div style="overflow-x: auto;">
      <table>
      <thead>
            <tr>
                <th style="text-align: center; background-color:rgb(140,177,16);" colspan="11" >
                  <strong style="font-size: 25px; color:white; ">Unternehmen </strong>
                </th>
            </tr>
                  <tr style="text-align: left;">         
                  <th><strong>ID</strong></th>
                  <th><strong>Name</strong></th>
                  <th><strong>Size</strong></th>
                  <th><strong>Industry</strong></th>
                  <th><strong>Location</strong></th>
                  <th><strong>PhoneNr.</strong></th>
                  <th><strong>E-mail</strong></th>
                  <th><strong>notes</strong></th>
                  <th><strong>URL</strong></th>
                  <th style="text-align: center;"><strong>EDIT</strong></th>
                  <th style="text-align: center;"><strong>DELETE</strong></th>
              </tr>
          </thead>
          <tbody>
          <?php
          require_once("connection.php");
          $search_query = "";
          if (isset($_GET['search']) && !empty($_GET['search'])) {
              $search_term = mysqli_real_escape_string($con, $_GET['search']);
              $search_query = " WHERE Cname LIKE '%$search_term%' OR industry LIKE '%$search_term%' OR location LIKE '%$search_term%' OR email LIKE '%$search_term%'";
          }
          
          //hier selektieren wir alle daten von tabelle users von datenbank

          $select="SELECT * FROM company" . $search_query . " ORDER BY id ";
          $tab=$con->query($select);

         //hier zeigen wir alle results die in datenbank gespeichert wurden

          while($row = $tab->fetch_assoc()){
              echo "<tr>";
              echo "<td><em>".$row["id"]."</em></td>";
              echo "<td><em>".$row["Cname"]."</em></td>";
              echo "<td><em>".$row["size"]."</em></td>";
              echo "<td><em>".$row["industry"]."</em></td>";
              echo "<td><em>".$row["location"]."</em></td>";
              echo "<td><em>".$row["phoneNumber"]."</em></td>";
              echo "<td><em>".$row["email"]."</em></td>";
              echo "<td><em>".$row["notes"]."</em></td>";
              echo "<td><em>".$row["URL"]."</em></td>";
              echo"<td style='text-align:center;'><a href='editunternehmen.php?id=". $row["id"] ."'> Edit </a></td>";
              echo"<td style='text-align:center;'><a href='deletecompany.php?id=". $row["id"] ."'> Delete </a></td>";
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
                <a href="addcompany.php" class="custom-btn"><button style="color:white; background-color:rgb(140,177,16);" class="btn">Add Company</button></a>
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



        
          
         
     



