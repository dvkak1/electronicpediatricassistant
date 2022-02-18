<?php

include "../controllers/CRUDController/pediatriciansideControllers/addNewLabResultCategory.php";
include "../controllers/CRUDController/pediatriciansideControllers/updateLabResultCategory.php";
include "../controllers/CRUDController/pediatriciansideControllers/deleteLabResultCategory.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>EpedA - Electronic Pediatric Assistant</title>
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p"
crossorigin="anonymous"/>
<link rel="stylesheet" href="style.css">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Goldman&display=swap" rel="stylesheet">
</head>
<body>
  <header>
    <div class="logo">
      <h1 class="logo-text"><a href="privatedoctorportal.php">E<span>ped</span>A</a></h1>
    </div>
    <ul class="nav">
      <li><a href="govtlinks.php">Government Links</a></li>
      <li><a href="patientsonvisitpedside.php">Patients on Visit</a></li>
      <li>
        <a href="#">Lab Results</a>
      </li>
      <li>
        <a href="#">Other Options</a>
        <ul>
          <li><a href="addpediainfoform.php">New Doctor?</a></li>
          <li><a href="manageprofile.php">Manage Profile</a></li>
          <li><a href="editdocprofile.php">Change Profile Image</a></li>
          <li><a href="adddoctorassistant.php">Add New Doctor Assistant</a></li>
          <li><a href="message.php">Message</a></li>
        </ul>
      </li>
      <li><a href="signin.php?logout=1">Logout</a></li>
    </ul>
  </header>

  <center>
   <div class="form-wrapper">
     <div class="content clearfix">
         <div class="auth-content">
           <div class="form-title">
             <h2>Add Laboratory Test Category</h2>
           </div>
           <form action="labresultcategoryCRUD.php" method="POST">
             <input type="hidden" name="labID" value="<?= $catLabID?>">
             <input type="text" name="labPatFN" class="text-input" placeholder="First Name of Patient"><br>
             <input type="text" name="labPatLN" class="text-input" placeholder="Last Name of Patient"><br>
             <input type="text" name="labCategory" class="text-input" placeholder="Lab Test Category" value="<?= $categoryShow?>"><br>
             <?php
             if (isset($_GET['upCat'])){
              echo "<input type='submit' name='update-lab-category' value='Update Category Name' class='btn'>";
            } else {
                echo "<input type='submit' name='lab-category' value='Add Category Name' class='btn'>";
            }
             ?>
           </form>
         </div>
     </div>
   </div>

       <h2>Laboratory Categories</h2>
       <table class="category-content-table">
         <thead>
           <tr>
             <th>Category</th>
             <th colspan="2">Action</th>
           </tr>
         </thead>
         <tbody>
           <?php
           include "../controllers/CRUDController/pediatriciansideControllers/showAllLabResultCategory.php";
            while ($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<td>". $row['category']."</td>";
              echo "<td><a href='labresultcategoryCRUD.php?upCat=". $row['labResultID']."' class='btn'>Update</a></td>";
              echo "<td><a href='labresultcategoryCRUD.php?cat=".$row['labResultID'] ."' class='btn'>Delete</a></td>";
              echo "</tr>";
            }
           ?>
         </tbody>
      </table>
 </center>

</body>
</html>
