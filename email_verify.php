<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

function send_verification($fullname, $email, $OTP){


    $mail = new PHPMailer(true);                              // Passing true enables exceptions
    try {

       
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'reelwave.films@gmail.com';                 // SMTP username
        $mail->Password = 'gswo falp lulo hmyv';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, ssl also accepted
        $mail->Port = 587;                                    // TCP port to connect to
    
        //Recipients
        $mail->setFrom('reelwave.films@gmail.com','Account Registration');
        $mail->addAddress($email);     // Add a recipient
        //Content
        $mail->isHTML(true);  // Set email format to HTML
        $mail->Subject = "OTP Verification";
        $mail->Body    = '<h2 style="margin-bottom: 5px;">ReelWave Movie Booking</h2>
        <p style="margin-top: 0;">Your Ticket to Cinematic Magic</p>
    </div><h3 style="color: #004aad; margin-bottom: 20px;">Hello, '.$fullname.'!</h3>
<p>Thank you for signing up at <strong>ReelWave Movie Booking</strong> - where every seat is the best seat in the house!</p>
<div class="movie-quote">
        "The cinema is a mirror by which we often see ourselves." - Alejandro González Iñárritu
    </div>
<p style="margin-top: 20px;">To complete your registration and unlock the full movie-going experience, please proceed to the OTP verification page and enter the code below to verify your email address.</p>
<p>Verification code:</p>
<div style="background-color: #f8f9fa; padding: 15px; border-radius: 5px; text-align: center; font-size: 24px; color: #004aad; font-weight: bold;">
        '.$OTP.' </div>
        <div class="footer">
        <p><strong>Security Notes:</strong></p>
        <ul>
            <li>Never share this code with anyone - ReelWave staff will never ask for it</li>
            <li>This email was sent because someone (hopefully you!) signed up using this address</li>
            <li>If you did not request this, please <a href="mailto:reelwave.films@gmail.com" style="color: #004aad;">contact us immediately</a></li>
            <li>For your safety, we recommend changing your password regularly</li>
        </ul>
<p style="margin-top: 20px;">©ReelWave Movie Booking. All rights reserved.</p>';

        $mail->send();
        ?>
            <script>
                alert("Email Successfully Sent!")
            </script>
        <?php
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }



}


?>
