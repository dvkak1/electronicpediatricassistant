<?php
require_once "../controllers/displayController/dropdownPediatricianController.php";
require_once "../controllers/displayController/dropdownClinicController.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p"
crossorigin="anonymous"/>
<link rel="stylesheet" href="style.css">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Goldman&display=swap" rel="stylesheet">
</head>
<body>
  <header>
    <div class="logo">
      <h1 class="logo-text"><a href="../index.php">E<span>ped</span>A</a></h1>
    </div>
    <i class="fa fa-bars menu-toggle"></i>
     <ul class="nav">
      <li><a href="aboutus.php">About Us</a></li>
      <li><a href="#">Find Pediatrician</a>
      <?php
        echo "<ul>";
        while($row = $result_spec_show->fetch_assoc()) {
        echo "<li><a href='findpediatrician.php?spec=".$row['specializationID']."'>".$row['specialization_name']."</a></li>";
      }
        echo "</ul>";
        echo "</li>";

      ?>
      <li><a href="#">Clinic</a>
        <?php
          echo "<ul>";
          while($row_clinic = $result_dropdown->fetch_assoc()) {
          echo "<li><a href='publicdoctorportal.php?pedID=".$row_clinic['pediaID']."'>".$row_clinic['name']."</a></li>";
        }
          echo "</ul>";
          echo "</li>";

        ?>
      <li><a href="govtlinks.php">Government Links</a></li>
      <li>
        <a href="#">Sign In</a>
        <ul>
          <li><a href="signin.php">Sign in as Doctor</a></li>
          <li><a href="doctorassistantlogin.php">Sign in as Doctor Assistant</a></li>
          <li><a href="signintopatientportal.php">Sign in as Patient</a></li>
        </ul>
      </li>
      <li><a href="register.php">Register</a></li>
    </ul>
  </header>

  <div class="page-wrapper">

    <div class="post-slider">
      <h1 class="slider-title">Government Links</h1>
      <i class="fas fa-chevron-left prev"></i>
      <i class="fas fa-chevron-right next"></i>

          <div class="post-wrapper">


            <div class="post">
              <center>
               <img src="../img/DOH.jpg" alt="" class="slider-image">
               <div class="post-info">
                 <h4>Department of Health</h4>
                 <p><a href="https://www.doh.gov.ph/">Click here to see news from DOH</a></p>
               </div>
              </center>
            </div>

            <div class="post">
              <center>
               <img src="../img/PhilHealth.jpg" alt="" class="slider-image">
               <div class="post-info">
                 <h4>PhilHealth</h4>
                 <p><a href="https://www.philhealth.gov.ph/#gsc.tab=0">Click here to see news from PhilHealth</a></p>
               </div>
              </center>
            </div>

            <div class="post">
              <center>
               <img src="../img/FDA_4.png" alt="" class="slider-image" >
               <div class="post-info">
                 <h4>Food and Drug Administration</h4>
                 <p><a href="https://www.fda.gov.ph/">Click here to see news from FDA</a></p>
               </div>
              </center>
            </div>

            <div class="post">
              <center>
               <img src="../img/NPC.png" alt="" class="slider-image" >
               <div class="post-info">
                 <h4>National Privacy Commission</h4>
                 <p><a href="https://www.privacy.gov.ph/">Click here to see news from the NPC</a></p>
               </div>
              </center>
            </div>


      </div>
    <!-- //POST SLIDER CLOSING TAG-->

  </div>
</div>
  <!-- //PAGE WRAPPER CLOSING TAG -->

  <div class="footer">
    <div class="footer-content">
      <div class="footer-section about">
        <h1 class="logo-text">E<span>ped</span>A</a></h1>
        <p>EpedA is designed to allow first time users to search pediatricians
        without requiring them to register into the system to receive medical attention
        on time and benefit from the system without delay.</p><br>
        <div class="contact">
          <span><i class="fas fa-phone"></i>&nbsp; (02)275-6061</span><br>

          <span><i class="fas fa-envelope"></i>&nbsp; dv_kakilala@yahoo.com</span>

        </div>
        <div class="socials">
          <a href="#"><i class="fab fa-facebook"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-youtube"></i></a>
        </div>
      </div>
      <div class="footer-section links">
        <h2>Quick Links</h2>
          <ul>
            <a href=""><li>About Us</li></a>
            <a href=""><li>Find Pediatrician</li></a>
            <a href=""><li>Clinic</li></a>
            <a href=""><li>Government Links</li></a>
            <a href=""><li>Sign In</li></a>
            <a href=""><li>Register</li></a>
          </ul>
      </div>
      <div class="footer-section contact-form">
        <center>
          <h2>Contact Us</h2>
        <form acton="index.html" method="POST">
          <input type="email" name="email" class="text-input contact-input" placeholder="Your email address...">
          <textarea name="message" class="text-input contact-input" placeholder="Your message..."></textarea>
         <button type="submit" class="btn btn-big"> <i class="fa fa-envelope"></i>Send</button>
        </center>
        </form>
      </div>
    </div>

    <div class="footer-bottom">
      &copy; epeda@gmail.com | Designed by Dale Kakilala
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
  <script src="../scripts.js"></script>


</body>
</html>
