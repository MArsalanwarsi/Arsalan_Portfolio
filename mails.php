<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
if (isset($_POST['data'])) {
  $name=$_POST['data'][0];
  $email=$_POST['data'][1];
  $subject=$_POST['data'][2];
  $message=$_POST['data'][3];
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
    $mail->SMTPDebug = 3;
    $mail->Debugoutput = 'error_log';

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'mohammadarsalanwarsi@gmail.com';                     //SMTP username
        $mail->Password   = 'meyj xqak gmay nxcr';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom("$email", "$name");
        $mail->addAddress('mohammadarsalanwarsi@gmail.com');     //Add a recipient
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Portfolio Enquiry';
        $mail->Body    = "<!DOCTYPE html>
<html>
  <head>
    <meta charset='UTF-8' />
    <meta name='viewport' content='width=device-width, initial-scale=1.0' />
    <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
      }
      .container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
      }
      .header {
        text-align: center;
        padding: 30px 0;
        background-color: #4b0082; /* Premium green color */
        color: #fff;
      }
      .header-text {
        font-size: 24px;
        font-weight: bold;
      }
      .content {
        padding: 30px;
        text-align: center;
      }
      .secondary-text {
        color: #666666;
        margin-bottom: 10px;
      }
      .indicator {
        color: #4b0082;
        font-weight: bold;
        font-size: large;
      }
      .footer {
        text-align: center;
        padding: 20px 0;
        border-top: 1px solid #ccc;
      }
      @media only screen and (max-width: 600px) {
        .container {
          padding: 10px;
        }
        .otp-code {
          font-size: 28px;
        }
      }
    </style>
  </head>
  <body>
    <div class='container'>
      <div class='header'>
        <h1 class='header-text'>Portfolio Enquiry</h1>
      </div>
      <div class='content'>
        <p class='secondary-text'><span class='indicator'>Name: </span>$name</p>
        <p class='secondary-text'><span class='indicator'>Email: </span>$email</p>
        <p class='secondary-text'><span class='indicator'>subject: </span>$subject</p>
        <p class='secondary-text'><span class='indicator'>Message: </span>$message</p>
      </div>
      <div class='footer'>
        <p>&copy; M.Arsalan Warsi Portfolio</p>
      </div>
    </div>
  </body>
</html>
";
        $mail->AltBody = "
        Name: $name
        Email: $email
        subject: $subject
        Message: $message
        ";

        $mail->send();
        echo "Sent";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
