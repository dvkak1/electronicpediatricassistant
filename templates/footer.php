<!-- <=?php
include "../controllers/displayController/displayFooterContent.php";
?> -->

<div class="footer">
  <div class="footer-content">
    <div class="footer-section about">
      <h1 class="logo-text">E<span>ped</span>A</a></h1>
      <p><?= $postFooterContent ?></p><br>
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
      </center>
      </form>
    </div>
  </div>

  <div class="footer-bottom">
    &copy; epeda@gmail.com | Designed by Dale Kakilala
  </div>
</div>
