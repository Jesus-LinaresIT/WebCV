<?php
require "./PHPMailer-master/src/PHPMailer.php";
require "./PHPMailer-master/src/SMTP.php";
require "./PHPMailer-master/src/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;


function endsWith($haystack, $needle) {
  return substr_compare($haystack, $needle, -strlen($needle)) === 0;
}

function sanitize_my_email($field) {
  $field = filter_var($field, FILTER_SANITIZE_EMAIL);
  if (filter_var($field, FILTER_VALIDATE_EMAIL)) {
      return true;
  } else {
      return false;
  }
}


if ( isset( $_POST['submit'] ) ) {

    extract($_POST);

    try {
        $mail = new PHPMailer(true);

        //Recipients
        $from = 'sender@asesoriait.com';
        $to_mail = 'jesus.linares320@gmail.com';
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->Username = $from;
        $mail->Password = 'Email Sender of AiT';
        $mail->setFrom($from, 'Jesus Linares');                           // Add a recipient
        $mail->addAddress($to_mail);                              // Name is optional


        // Content
        $mail->isHTML(true);  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->Body.= "<span><b>Email: </b></span>" . $email . "<br>";


        //check if the email address is invalid $secure_check
        $secure_check = sanitize_my_email($to_mail);
        if ($secure_check) {
          $mail->send();
          header("location:../index.html");
        } else { //send email
          echo "Invalid input";

        }

    } catch(Exception $e) {
      echo 'Message: ' . $e->getMessage();
    }

}

?>
