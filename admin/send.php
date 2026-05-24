<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

/* ✅ Correct path from admin folder */
require "vendor/autoload.php";
include "db.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

/* ✅ Load .env from root portfolio folder */
$dotenv = Dotenv::createImmutable(__DIR__ );
$dotenv->load();

if(isset($_POST['send'])){

    $to = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $mail = new PHPMailer(true);

    try {

        // 🔧 SMTP SETTINGS
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;

        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // 📩 SENDER (FIXED)
        $mail->setFrom($_ENV['EMAIL_USER'], 'Portfolio Admin');
        $mail->addAddress($to);

        // 📄 EMAIL CONTENT
        $mail->isHTML(true);
        $mail->Subject = $subject;

        $mail->Body = "
            <div style='font-family:Arial;padding:10px'>
                <h2>Hello 👋</h2>
                <p>$message</p>
                <hr>
                <small>This message is sent from Portfolio Admin Panel.</small>
            </div>
        ";

        $mail->send();

        echo "<script>
            alert('Reply sent successfully!');
            window.location='dashboard.php';
        </script>";

    } catch (Exception $e) {
        echo "Error: {$mail->ErrorInfo}";
    }
}
?>