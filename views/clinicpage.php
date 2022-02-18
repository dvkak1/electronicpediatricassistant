<?php
  require_once "../controllers/displayController/dropdownPediatricianController.php";
  require_once "../controllers/displayController/searchFormController.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Welcome to EpedA - Electronic Pediatric Assistant</title>
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
        echo "<li><a href='views/findpediatrician.php?spec=".$row['specializationID']."'>".$row['specialization_name']."</a></li>";
      }
        echo "</ul>";
        echo "</li>";

      ?>
      <li><a href="clinic.php">Clinic</a></li>
      <li><a href="views/govtlinks.php">Government Links</a></li>
      <li>
        <a href="#">Sign In</a>
        <ul>
          <li><a href="views/signin.php">Sign in as Doctor</a></li>
          <li><a href="views/doctorassistantlogin.php">Sign in as Doctor Assistant</a></li>
          <li><a href="views/signintopatientportal.php">Sign in as Patient</a></li>
        </ul>
      </li>
      <li><a href="views/register.php">Register</a></li>
    </ul>
  </header>

  <div class="page-wrapper">
  <div class="content clearfix">


    <div class="main-content">
      <h1 class="recent-posts-title">Available <?= $specShow ?> Doctors</h1>

      <div class="post" id="instruction">
        <!-- How it Works -->
        <img src="../img/arrow.png" class="post-image">
        <div class="how-it-works">
          <h4>How it works</h4>
        </div>
         <div class="post-preview">
           <h3>Getting started</h3>
           <p><span>Step 1</span>  Search location to find <?= $specShow ?> near you. </p>
           <p><span>Step 2</span> Choose location to view details.</p><br>
         </div>
      </div>
    <?php
      foreach($fetchDatas AS $fetchData) {
          echo "<div class='post'>";
          echo "<img src='../img/Capture.jpg' class='post-image'>";
          echo "<div class='post-preview' id='clinic-info'>";
          echo "<p> <span>Doctor :</span>" . $fetchData['pedFirstName'] . " " . $fetchData['pedLastName']  ."</p>";
          echo "<p> <span>Specialization :</span>" . $fetchData['specialization_name'] ."</p>";
          echo "<p> <span>Clinic Address :</span> " .  $fetchData['stNo'] . " , " . $fetchData['stName'] . " , " . $fetchData['ctName'] . " , " . $fetchData['prvName'] . "</p>";#2421 Leon Guinto St, Malate, Manila</p><br>
          echo "<a href='publicdoctorportal.php?pedID=". $fetchData['pediaID'] ."' class='btn read-more'>View Profile</a>";
          echo "</div>";
          echo "</div>";
        }
      ?>

      <?php
        foreach($searchPediatricians AS $searchPediatrician) {
            echo "<div class='post'>";
            echo "<img src='../img/Capture.jpg' class='post-image'>";
            echo "<div class='post-preview' id='clinic-info'>";
            echo "<p> <span>Doctor :</span>" . $searchPediatrician['pedFirstName'] . " " . $searchPediatrician['pedLastName']  ."</p>";
            echo "<p> <span>Specialization :</span>" . $searchPediatrician['specialization_name'] ."</p>";
            echo "<p> <span>Clinic Address :</span> " .  $searchPediatrician['stNo'] . " , " . $searchPediatrician['stName'] . " , " . $rowsearch['ctName'] . " , " . $rowsearch['prvName'] . "</p>";#2421 Leon Guinto St, Malate, Manila</p><br>
            echo "<a href='publicdoctorportal.php?pedID=". $searchPediatrician['pediaID'] ."' class='btn read-more'>View Profile</a>";
            echo "</div>";
            echo "</div>";
          }
      ?>


    </div>


    <div class="sidebar">

      <div class="section search">
        <h2 class="section-title">Search</h2>
        <form action="findpediatrician.php" method="post">
          <input type="hidden" name="spec-ID" value="<?= $specShow ?>">
          <input type="text" name="search-term" class="text-input" placeholder="Search..."><br>
          <input type="submit" name="search-ped-btn" class="btn" value="Search">
        </form>
      </div>
      <br><br><br>
      <div class="section topics">
        <h2 class="section-title">Location</h2>
        <?php
         foreach($showAllLocations AS $showAllLocation) {
        echo "<ul>";
        echo "<li><a href='findpediatrician.php?specID2=". $showAllLocation['specializationID']."&prvID=".$showAllLocation['Prov_ID']."'>". $showAllLocation['prvName'] ."</a></li>";
        echo "</ul>";
      }
      ?>
      </div>

   </div>
  </div>
  </div>


</body>
</html>
