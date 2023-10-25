<?php 
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'phpMailer/Exception.php';
    require 'phpMailer/PHPMailer.php';
    require 'phpMailer/SMTP.php';

    /*session_start();
    $username = $_SESSION[''];
    */

    if(isset($_POST['sendmail']))
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $msg = $_POST['message'];

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $to = 'manal.chailou@uir.ac.ma';
        $from = 'bot.uir.ad@gmail.com';

        $mail -> Host = 'smtp.gmail.com';
        $mail -> SMTPAuth = true;
        $mail -> Username = $from;
        $mail -> Password = "tnluosbbmksvogep";
        $mail -> SMTPSecure = 'ssl';
        $mail -> Port = 465;
        $mail -> setFrom($email);
        $mail -> addAddress($to);
        $mail -> isHTML(true);
        $mail -> Subject = 'Message Received (From Contact us)';
        $mail -> Body = "Name : $name <br>Subject: $subject <br>Message : $msg";
        $mail -> send();

        if ($mail) {
          echo "<script type=\"text/javascript\">
                  alert(\"Message Sent! Thank you for contacting us.\");
                  window.location = \"cheif_welcome.php\"
                </script>";

        }
    }
?>      