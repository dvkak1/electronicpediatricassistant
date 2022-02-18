<?php

?>

<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p"
crossorigin="anonymous"/>
<meta name="viewport" content="width-device-width, initial-scale=1.0">
<link rel="stylesheet" href="style.css">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Goldman&display=swap" rel="stylesheet">
<title>EpedA - Electronic Pediatric Assistant</title>
</head>
<body>
  <div class="auth-content">
    <div class="form-title">
      <h2>Lab Result of Patient</h2>
    </div>
    <?php while($row = $resultlab->fetch_assoc()) {
      echo "<br>";
      echo "<input type='hidden' name='labResID' value='". $row['labResultID']."'>";
      echo "<img src='". $row['labResult'] ."' width='300px' height='400px;'>". "<br>";
      echo "<br>";
      echo "<br>" . "<textarea class='text-input'>" .$row['comments'] . "</textarea>" . "<br>";
    } ?>
    <br>
    </div>
</body>
</html>
