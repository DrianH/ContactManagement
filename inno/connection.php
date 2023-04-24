<?php
        $server="localhost";
        $db="InnoDB";
        $user="root";
        $pwd="";

        $con = new mysqli($server, $user, $pwd, $db);
        // Check connection
        if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
        }

?>

<?php
/*
    $server="localhost";
    $db="stylenetsql1";
    $user="stylenetsql1";
    $pwd="Stylenet1234";

    $conn = new mysqli($server, $user, $pwd, $db);

    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    */
?>
