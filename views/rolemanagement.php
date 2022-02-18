<?php

require_once "../controllers/administrator-controllers/add-role-Controller.php";
require_once "../controllers/administrator-controllers/fetch-all-user-roles-Controller.php";
require_once "../controllers/administrator-controllers/restore-role-controller.php";
require_once "../controllers/administrator-controllers/delete-role-controller.php";

?>

<!DOCTYPE html>
<html lang="en">
  <meta charset="utf-8">
  <meta name="viewport" display="width-device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
<body>
  <nav>
    <a href="admin.php" class="logo">ePedA</a>
  </nav>



  <center>
    <?php
     if(count($errorRole) > 0) {
       foreach($errorRole AS $eR):
       echo $eR;
     endforeach;
     }
    ?>



    <div class="wrapper">
      <div class="form">
          <h2>Add User Role</h2>
        <form action="rolemanagement.php" method="POST">
        <div class="input_field">
          <input type="text" placeholder="Enter User Role" name="user-role" class="input">
        </div>
        <div class="submit_field">
          <input type="submit" value="Submit" name="add-role" class="btn">
        </div>
        </form>
      </div>
    </div>

    <div class="user-role-table-container">
      <table class="user-role-list-table">
        <thead>
          <tr>
            <th>Role Category</th>
            <th>Action 1</th>
            <td>Action 2</th>
          </tr>
        </thead>
        <tbody>
          <?php while($rows = $result->fetch_assoc()) {  ?>
          <tr>
            <td><?= $rows['roleLink'] ?></td>
            <td><a href="rolemanagement.php?delete=<?= $rows['roleID']?>"><input type="submit" class="action-btn" value="Delete"></input></a></td>
            <td><a href="rolemanagement.php?restore=<?= $rows['roleID']?>"><input type="submit" class="action-btn" value="Restore"></input></a></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>

</center>
</body>
</html>
