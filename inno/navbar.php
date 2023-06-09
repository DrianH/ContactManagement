   
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
  <symbol id="bootstrap" viewBox="0 0 118 94">
    <title>Bootstrap</title>
    <path fill-rule="evenodd" clip-rule="evenodd" d="M24.509 0c-6.733 0-11.715 5.893-11.492 12.284.214 6.14-.064 14.092-2.066 20.577C8.943 39.365 5.547 43.485 0 44.014v5.972c5.547.529 8.943 4.649 10.951 11.153 2.002 6.485 2.28 14.437 2.066 20.577C12.794 88.106 17.776 94 24.51 94H93.5c6.733 0 11.714-5.893 11.491-12.284-.214-6.14.064-14.092 2.066-20.577 2.009-6.504 5.396-10.624 10.943-11.153v-5.972c-5.547-.529-8.934-4.649-10.943-11.153-2.002-6.484-2.28-14.437-2.066-20.577C105.214 5.894 100.233 0 93.5 0H24.508zM80 57.863C80 66.663 73.436 72 62.543 72H44a2 2 0 01-2-2V24a2 2 0 012-2h18.437c9.083 0 15.044 4.92 15.044 12.474 0 5.302-4.01 10.049-9.119 10.88v.277C75.317 46.394 80 51.21 80 57.863zM60.521 28.34H49.948v14.934h8.905c6.884 0 10.68-2.772 10.68-7.727 0-4.643-3.264-7.207-9.012-7.207zM49.948 49.2v16.458H60.91c7.167 0 10.964-2.876 10.964-8.281 0-5.406-3.903-8.178-11.425-8.178H49.948z"></path>
  </symbol>
  <symbol id="grid" viewBox="0 0 16 16">
    <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zM2.5 2a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zM1 10.5A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3z"/>
  </symbol>
</svg>

<main>
  <header class="p-3 bg-dark text-white">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">

<img src="images/FHT_Logo.svg.png" width="40" height="32" role="img" class="bi me-2">
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="index.php" class="nav-link px-2 text-white">Home</a></li>
          <?php
              if(!isset($_SESSION["email"]) && !isset($_SESSION["role"])){
          ?>
          <li><a href="support.php" class="nav-link px-2 text-white">Support</a></li>
          <li><a href="about.php" class="nav-link px-2 text-white">About</a></li>
              </ul>
        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
          <input type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search">
        </form>

        <div class="text-end">
          <button onclick="location.href='login.php'" type="button" class="btn btn-outline-light me-2">Login</button>
        </div>

        <?php
              }
                            else if(isset($_SESSION["email"]) && isset($_SESSION["role"])){
                             if($_SESSION["role"] == "Gast"){
                            ?>
          <li><a href="support.php" class="nav-link px-2 text-white">Support</a></li>
          <li><a href="about.php" class="nav-link px-2 text-white">About</a></li>
        </ul>
        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
          <input type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search">
        </form>
        <div class="text-end">
          <button onclick="location.href='profile.php'" type="button" class="btn btn-outline-light me-2"><?php echo $_SESSION["username"]." "?></button>
        </div>


        <?php
                              }
                              else if($_SESSION["role"] == "Employee"){
                              ?>
          <li><a href="support.php" class="nav-link px-2 text-white">Support</a></li>
          <li><a href="about.php" class="nav-link px-2 text-white">About</a></li>
          <li><a href="calendar.php" class="nav-link px-2 text-white">Appointment</a></li>
          <li><a href="viewcontacts.php" class="nav-link px-2 text-white">Contacts</a></li>
          <li><a href="viewcompany.php" class="nav-link px-2 text-white">Company</a></li>
          <li><a href="task.php" class="nav-link px-2 text-white">Tasks</a></li>
          <li><a href="mailing.php" class="nav-link px-2 text-white">Mailing</a></li>
        </ul>
        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
          <input type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search">
        </form>
        <div class="text-end">
          <button onclick="location.href='profile.php'" type="button" class="btn btn-outline-light me-2"><?php echo $_SESSION["username"]." "?></button>
        </div>

                              <?php
                              }
                              else{
                                ?>
          <li><a href="support.php" class="nav-link px-2 text-white">Support</a></li>
          <li><a href="about.php" class="nav-link px-2 text-white">About</a></li>
          <li><a href="viewuser.php" class="nav-link px-2 text-white">Users</a></li>
          <li><a href="viewcontacts.php" class="nav-link px-2 text-white">Contacts</a></li>
          <li><a href="viewcompany.php" class="nav-link px-2 text-white">Company</a></li>
          <li><a href="calendar.php" class="nav-link px-2 text-white">Appointment</a></li>
          <li><a href="task.php" class="nav-link px-2 text-white">Tasks</a></li>
          <li><a href="mailing.php" class="nav-link px-2 text-white">Mailing</a></li>

        </ul>
        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
        </form>
        <div class="text-end">
          <button onclick="location.href='profile.php'" type="button" class="btn btn-outline-light me-2">MyProfile - <?php echo $_SESSION["username"]." "?></button>
        </div>
                                <?php
                              }
        }
        ?>
      </div>
    </div>
  </header>
</main>
