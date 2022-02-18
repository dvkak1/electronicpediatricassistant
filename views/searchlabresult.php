<?php
require_once "../controllers/labResultController/searchLabController.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="style.css">
<meta name="viewport" display="width-device-width, initial-scale=1.0">
<title>EpedA - Electronic Pediatric Assistant</title>
</head>
<body>
  <nav>
    <a href="index.php" class="logo">EpedA</a>
    <ul>
    </ul>
  </nav>
  <div class="wrapper">
    <div class="form">
      <form action="searchlabresult.php" method="POST">
        <div class="input_field">
          <input type="text" class="input" name="firstnlab" placeholder="First Name" value="">
        </div>
        <div class="input_field">
          <input type="text" class="input" name="midnlab" placeholder="Middle Name" value="">
        </div>
        <div class="input_field">
          <input type="text" class="input" name="lastnlab" placeholder="Last Name" value="">
        </div>
        <div class="submit_field">
          <input type="submit" class="btn" name="searchlabres-btn">
        </div>
    </div>
  </div>
</body>

<center>
<?php while($search_return = $result->fetch_assoc()) {?>

<img src="<?= $search_return['labResult']; ?>" width="650"><br><br><br>
<div class="input_field">
  <textarea><?= $search_return['comments'] ?></textarea>
</div>

<?php  } ?>
</center>
</html>
