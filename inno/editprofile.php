<?php
session_start();
if (isset($_SESSION["email"]) && isset($_SESSION["role"])) {
    ?>
    <!Doctype html>
    <html lang="en">
    <head>
        <link href="carousel.css" rel="stylesheet">
        <link href="css/hovereffect.css" rel="stylesheet" type="text/css"/>

        <?php
        include('header.php');
        include('navbar.php');
        include('connection.php');

        if (isset($_POST['submit'])) {
            $id_users = $_POST['id_users'];
            $anrede = $_POST['anrede'];
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $username = $_POST['username'];
            $role = $_POST['role'];

            $_SESSION["email"] = $_POST["email"];

            $update = "UPDATE users SET anrede=?, firstname=?, lastname=?, email=?, username=?, role=? WHERE id_users=?";
            $stmt = $con->prepare($update);
            $stmt->bind_param("ssssssi", $anrede, $firstname, $lastname, $email, $username, $role, $id_users);
            $stmt->execute();
            echo "<script>window.location.href='index.php'</script>";

        }

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

            Edit Profile
        </h1>
        <br>
        <br>

        <section style="background-color: #eee;">
            <div class="container py-5">
                <form action="editprofile.php" method="POST">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card mb-4">
                                <div class="card-body text-center">
                                    <img src="images/Profile.jpg" alt="avatar"
                                         class="rounded-circle img-fluid" style="width: 150px;">
                                    <h5 class="my-3"><?php echo $row["firstname"]; ?></h5>
                                    <p class="text-muted mb-1">FH Technikum Wien</p>
                                    <p class="text-muted mb-4"><?php echo $row["role"]; ?></p>

                                </div>
                            </div>

                        </div>
                        <div class="col-lg-8">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <input type="hidden" name="id_users" value="<?php echo $row["id_users"]; ?>">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Anrede</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" name="anrede"
                                                   value="<?php echo $row["anrede"]; ?>">
                                                   </div>
                                                   </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">First Name</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" name="firstname"
                                                   value="<?php echo $row["firstname"]; ?>">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Last Name</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" name="lastname"
                                                   value="<?php echo $row["lastname"]; ?>">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Username</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" name="username"
                                                   value="<?php echo $row["username"]; ?>">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">E-mail</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="email" name="email"
                                                   value="<?php echo $row["email"]; ?>">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                    <div class="col-sm-3">
                                            <p class="mb-0">Role</p>
                                        </div>
                                        <div class="col-sm-9">
                                        <input class="form-control" type="text" name="role" value="<?php echo $row["role"]; ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center mb-2">
                                <button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
                                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp

                                <a href="logout.php" type="button" class="btn btn-outline-primary ms-1">Logout</a>
                            </div>
                        </div>
                    </div>
                </form>
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
} else {
    header("location:index.php");
}
?>
</html>
