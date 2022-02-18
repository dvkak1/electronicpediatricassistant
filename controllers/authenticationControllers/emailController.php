<?php

require_once '../vendor/autoload.php';
require_once '../config/constants.php';

// Create the Transport
$transport = (new Swift_SmtpTransport('smtp.gmail.com', 465 , 'ssl'))
  ->setUsername(EMAIL)
  ->setPassword(PASSWORD);

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);

function sendDisapprovalEmail($userEmail) {
  global $mailer;
  $body = '<!DOCTYPE html>
           <html lang="en">
           <head>
           <meta charset="utf-8">
               <title>We are sorry</title>
           </head>
           <body>
           <p>Due to discrepancies with your credentials, we cannot verify and grant you
           access to EpedA. Our deepest apologies</p>
           </body>
           </html>';

           // Create a message
           $message = (new Swift_Message('Sorry, we cannot verify you.'))
             ->setFrom(EMAIL)
             ->setTo($userEmail)
             ->setBody($body, 'text/html');

           // Send the message
           $result = $mailer->send($message);
}


//Function triggered for newly registered users notifying to wait for verification.
//Entire URL on Line 54 of code not passed on the address bar of browser after clicking
//on the verification link. Body of message is not showing, could be a possible cause
//on why the activation link token is not showing on address bar.
//Bug fixed. Root cause of error is in the loginController where the verifyDoctor function
//has the header(location:../views/signin.php) line which prevents the activation link token
//from being fetched
function sendVerificationEmail($userEmail, $token) {
   global $mailer;
   $msgbody = '<!DOCTYPE html>
               <html lang="en">
               <head>
               <meta charset="utf-8">
                <title>Welcome to EpedA</title>
               </head>
               <body>
               <p>Greetings pediatrician, welcome to EpedA. Please click on the link to get started.</p>
               <a href="https://isproj2b.benilde.edu.ph/EpedA/views/signin.php?token='. $token .'">Verify your email</a>
               </body>
               </html>';

      $message = (new Swift_Message('Congratulations, you are now verified. Start using EpedA now!'))
          ->setFrom(EMAIL)
          ->setTo($userEmail)
          ->setBody($msgbody, 'text/html');

      $result = $mailer->send($message);

 }


function sendRegistrationCompleteMail($userEmail, $token){
  global $mailer;
  $body = '<!DOCTYPE html>
           <html lang="en">
           <head>
           <meta charset="utf-8">
               <title>Thank you for registering</title>
           </head>
           <body>
           <p>Dear pediatrician, please wait as we will verify whether your credentials deem you
              fit to use EpedA.</p>
           </body>
           </html>';


    // Create a message
    $message = (new Swift_Message('Verify your email'))
      ->setFrom(EMAIL)
      ->setTo($userEmail)
      ->setBody($body, 'text/html');

    // Send the message
    $result = $mailer->send($message);
}


function sendPasswordResetLink($userEmail, $token) {

  global $mailer;
  $body = '<!DOCTYPE html>
  <html lang="en">
  <head>
  <meta charset="utf-8>
  <title>Change your password</title>
  </head>
  <body>
  <div class="wrapper">
  <p>Hi! Please click on the link below to change your password.</p>
         <a href="https://isproj2b.benilde.edu.ph/EpedA/views/reset-password.php?password-token='. $token . '">
         Reset your password
        </a>
  </div>
  </body>';


  // Create a message
  $message = (new Swift_Message('Reset your password'))
    ->setFrom(EMAIL)
    ->setTo($userEmail)
    ->setBody($body, 'text/html');

  // Send the message
  $result = $mailer->send($message);

}



?>
