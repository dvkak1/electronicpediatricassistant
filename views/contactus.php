<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width-device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <nav>
    <a href="#" class="logo">ePedA</a>
  </nav>

<center>
  <br>
  <h1><i>Contact Us</i></h1><br>
  <h3>We'd like to hear how we can serve you better.<br> You can also email or give us a call.</h3>

  <div class="contact-wrapper">
    <div class="contact-form">
      <!-- <div class="contact-title">
        Contact Form
      </div>
       -->
      <form action="contactus.php" method="POST">
        <div class="input_field">
          <input type="text" class="input" name="send_name" placeholder="Full Name">
        </div>
        <div class="input_field">
          <input type="text" class="input" name="email" placeholder="Email">
        </div>
        <div class="input_field">
          <textarea class="input" name="message" placeholder="Type your message..."></textarea>
        </div>
        <div class="submit_field">
          <input type="submit"  class="btn" name="submit-message" value="Send Message">
        </div>
      </form>
    </div>
  </div>
<center>
  <section class="contact">
    <div class="contact-info">
      <div class="box">
        <div class="icon"><i class="fa fa-envelope"></i></div>
        <div class="text">
          <h2>Email</h2>
          <p>epeda@gmail.com</p>
        </div>
      </div>
      <div class="box">
        <div class="icon"><i class="fa fa-phone" aria-hidden="true"></i></div>
        <div class="text">
          <h2>Phone</h2>
          <p>09064058590</p>
        </div>
      </div>
    </div>
  </section>
</center>


</center>
</body>
</html>
