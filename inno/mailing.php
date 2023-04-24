<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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
    
    $sql = "select * from users;";
    $stmt = $con->prepare($sql);
    $stmt->execute();

    $res = $stmt->get_result();

    $options = "";
    while($row = $res->fetch_assoc()){
        $options = "<option value = '".$row["email"]."'>".$row["firstname"]." ".$row["lastname"]."</option>";
    }

    require_once "vendor/autoload.php";

    $mail = new PHPMailer(true);

    $mail->setFrom($_SESSION["email"], $_SESSION["username"]);
    $mail->addReplyTo($_SESSION["email"], $_SESSION["username"]);

    $mail->isHTML(true);
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPDebug = 1;
    $mail->Host = 'smtp.gmail.com';  //gmail SMTP server
    $mail->Username = "contact.management.fh@gmail.com";   //email
    $mail->Password = "pefjhxvyypyxyuse";   //16 character obtained from app password created
    $mail->Port = 465;                    //SMTP port
    $mail->SMTPSecure = "ssl";

    if(isset($_POST["receiver"])) $mail->addAddress($_POST["receiver"]);
    if(isset($_POST["subject"])) $mail->Subject = $_POST["subject"];
    if(isset($_POST["content"])) $mail->Body = $_POST["content"];
    
    if(isset($_POST["submit"])){
        try{
            $mail->send();
        }
        catch(Exception $e){
            echo "<script type='text/javascript'>alert(" . $mail->ErrorInfo . ");</script>";
        }
    }

    $mail->smtpClose();
    ?>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-4">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                        <div>
                            <h1 class="text-center text-muted ">Send Mail</h1>
                        </div>
                        <br>
                        <div class="form-group mb-3">
                            <label>Receiver</label>
                            <br>
                            <select name="receiver">
                                <?php echo $options; ?>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label>Subject</label>
                            <br>
                            <input type="text" name="subject" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Content</label>
                            <br>
                            <textarea name="content" rows="10" cols="55">
                            </textarea>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" name="submit" style="color:white; background-color:rgb(140,177,16); border: 4px solid rgb(140,177,16);" class="btn btn-outline-success ms-1">Send</button>
                        </div>
                        <br>
                    </form>
                </div>
                <div class="col-md-4">
                </div>
            </div>
        </div>
    <?php
    include('footer.php');
    ?>
    <script src="../js/bootstrap.bundle.min.js"></script>
    </body>
<?php
}
else{
    header("location:index.php");                             
}
?>
</html>