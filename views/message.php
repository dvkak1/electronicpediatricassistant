<?php

require_once "../controllers/messagingControllers/doctorMessagingController.php";
require_once "../controllers/notificationControllers/newLabResultController.php";
require_once "../controllers/messagingControllers/updateIfReadAndSelectMessageController.php";
require_once "../controllers/messagingControllers/searchUserToMessageControllerPediatricianSide.php";

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
      <h1 class="logo-text"><a href="privatedoctorportal.php">E<span>ped</span>A</a></h1>
    </div>
    <ul class="nav">
      <li><a href="govtlinks.php">Government Links</a></li>
      <li>
        <a href="patientsonvisitpedside.php">Patients on Visit</a>
        <!-- <ul>
          <li><a href="createnewmedrecorddrview.php">Create Medical Record</a></li>
        </ul> -->
      </li>
      <li>
        <a href="labResultList.php">Lab Results</a>
      </li>
      <li>
        <a href="#">Other Options</a>
        <ul>
          <li><a href="addpediainfoform.php">New Doctor?</a></li>
          <li><a href="manageprofile.php">Manage Profile</a></li>
          <li><a href="editdocprofile.php">Change Profile Image</a></li>
          <li><a href="adddoctorassistant.php">Add New Doctor Assistant</a></li>
          <li><a href="uploadlabresult.php">Upload Laboratory Result</a></li>
          <li><a href="message.php">Message</a></li>
        </ul>
      </li>
      <li>
        <a href="#">Search</a>
        <ul>
          <li><a href="searchmedrecord.php">Search Medical Record Form</a></li>
        </ul>
      </li>
      <li><a href="signin.php?logout=1">Logout</a></li>
    </ul>
  </header>

  <div class="message-wrapper">

  <div class="parent-search">
    <div class="boxContainer">
      <table class="elementContainer">
        <tr>
            <form action="message.php" method="POST">
           <td>
            <input type="text" placeholder="First Name" class="search" name="search_firstN" autocomplete="off">
          </td>
          <td>
            <input type="text" placeholder="Last Name" class="search" name="search_lastN" autocomplete="off">
          </td>
          <td>
            <button class="btn"><i class="fa fa-search" aria-hidden="true"></i></button>
          </td>
          </form>
        </tr>
      </table>
       </div>
  </div>


     <?php
     include "../controllers/messagingControllers/searchUserToMessageControllerPediatricianSide.php";


      if ($result->num_rows ==  0)  {

        echo "<div class='no-record-warning'>";
        echo "<p>No records found <p>";
        echo "</div>";

      }  else   {

        $row = $result->fetch_assoc();

        $search_PediaID = $row['pediaID'];

        $search_RecevID = $row['userToID'];
        $search_RecevFN = $row['receiverFirstName'];
        $search_RecevLN = $row['receiverLastName'];


        if(($search_msg_query_FN = $search_RecevFN) && ($search_msg_query_LN = $search_RecevLN)) {

          echo  "<div class='search-chat-form'>";
          echo  "<form action='message.php' method='post'>";
                if(count($msg_error) > 0):
                  foreach($msg_error AS $msg_err):
                    echo $msg_err . "<br>";
                  endforeach;
                endif;
            echo "<input type='hidden' name='messageToID' value='". $row['userToID'] . "'>";
            echo  "<textarea class='input' name='search-form-message' placeholder='Send message to " . $row['receiverFirstName']. " " . $row['receiverLastName']. "..'></textarea>";
            echo  "<input type='submit' class='btn' name='doctor-to-user-search' value='Send' id='send-search'>";
            echo  "</form>";
            echo "</div>";

            echo "<div style='display:none'>";
            echo "<div class='parent'>";
            echo "<div class='main-container'>";
            echo "<div class='list-header'>";
            echo  "</div>";
            echo  "<div class='users-list'>";
            echo   "<div class='user-list-title'>";
            echo "</div>";
            echo  "<div class='users'>";
            echo  "<form method='POST'>";
            echo   "</form>";
            echo "</div>";
            echo "</div>";

            echo "<div class='users-list'>";
            echo "<div class='user-list-title'>";
            echo "</div>";
            echo "<div class='users'>";
            echo "<form method='POST'>";

            echo "</form>";
            echo "</div>";
            echo "</div>";
            echo "</div>";

            echo "<div class='chatbox'>";
            echo "<div class='msg-header'>";
            echo "<center>";
            echo "</center>";
            echo "</div>";
            echo "<div class='chat-logs'>";
            echo  "</div>";
            echo "</div>";
            echo "</div>";

        }

      }



    ?>

  <div class="user-container">
    <div class="list-header">
    <center>
        <h4><i>People</i></h4>
    </center>
    </div>
    <div class="users-list">
      <center>
      <div class="user-list-title">
        <h4><i>Patients</i></h4>
      </div>
      <div class="users">
       <form method="POST">
          <p>Patient<a href="message.php?patientID=<?= $patient_ID ?>"> <?= $patient_FN . " " . $patient_LN ?></a></p>
          <?php if ($row_total > 0)  {
           echo   " " . "<p style='color:red'> ".  $row_total. " message(s)</p>&nbsp;&nbsp";
         } else {
           echo "";
         }
           ?>
        </form>
      </div>
    </center>
    </div>
    <div class="users-list">
      <center>
      <div class="user-list-title">
        <h4><i>Doctor Assistant</i></h4>
      </div>
      <div class="users">
       <form method="POST">
          <p>Doctor Assistant <a href="message.php?drAsstID=<?= $assistant_ID ?>"><?=  $drAssistFN . " " . $drAssistLN ?></a></p>
          <?php if ($row_total_2 > 0)  {
           echo " " . "<p style='color:red'>" . $row_total_2. " message(s)</p>&nbsp;&nbsp";
         } else {
           echo "";
         }
         ?>
        </form>
      </div>
    </center>
    </div>
    </div>
<!-- </div> -->
  <div class="chatbox">
    <div class="message-header">
      <?php

      while ($row_msg = $result_doctor->fetch_assoc()) {
        $sender_id = $row_msg['userFrom'];
        $receiver_id = $row_msg['userTo'];
        $msg_content = $row_msg['message'];
        $msg_date_time = $row_msg['dateSent'];

     if (isset($_GET['patientID'])) {
      echo  "<center>";
      echo  "<h4>". $patient_FN . " " . $patient_LN . "</h4>";
      echo "</center>";
    } elseif (isset($_GET['drAsstID']))  {
      echo  "<center>";
      echo  "<h4>". $drAssistFN . " ".  $drAssistLN  . "</h4>";
      echo  "</center>";
    } else {
      echo  "<center>";
      echo  "<h4> My Messages</h4>";
      echo "</center>";
    }
      ?>
    </div>
    <div class="chat-logs">
      <?php

      while ($row_msg = $result_doctor->fetch_assoc()) {
        $sender_id = $row_msg['userFrom'];
        $receiver_id = $row_msg['userTo'];
        $msg_content = $row_msg['message'];
        $msg_date_time = $row_msg['dateSent'];

      ?>
      <?php
        if (($pedID == $sender_id AND $patient_ID == $receiver_id) && (isset($_GET['patientID']))) {

            echo "
            <div class='chat doctor'>
              <p class='chat-message'>" . $msg_content . "</p>
             <span class='time'>". "You " . "|" . $msg_date_time . "</span>
            </div>";

        } else if (($pedID == $receiver_id AND $patient_ID == $sender_id) && (isset($_GET['patientID'])) ) {


           echo "
               <div class='chat patient'>
                <p class='chat-message'>". $msg_content. "</p>
               <span class='time'>" . $msg_date_time . "</span>" .
               "</div>";


        } else if (($pedID == $sender_id AND $assistant_ID == $receiver_id) && (isset($_GET['drAsstID']))) {
          echo "
          <div class='chat doctor'>
            <p class='chat-message'>" .$msg_content . "</p>
           <span class='time'>". "You ". "|" . $msg_date_time . "</span>
          </div>";

        } else if (($pedID == $receiver_id AND $assistant_ID == $sender_id) && (isset($_GET['drAsstID']))) {
          echo "
                 <div class='chat assistant'>
                 <p class='chat-message'>". $msg_content . "</p>
                 <span class='time'>" . $msg_date_time . "</span>
                 </div>";
        }
  }
      ?>
    </div>
<?php
    if (isset($_GET['patientID'])) {
    echo "<div class='chat-form'>";
    echo "<form action='message.php' method='POST'>";
        echo "<textarea class='input' name='message'></textarea>"."<br>";
        echo "<input type='submit' name='send-patient-message' value='Send' class='btn' id='message-btn'>";
      echo "</form>";
    echo "</div>";
    echo "</div>";



  }  else if (isset($_GET['drAsstID'])){
    echo "<div class='chat-form'>";
    echo "<form action='message.php' method='POST'>";
        echo "<textarea class='input' name='message'></textarea>"."<br>";
        echo "<input type='submit' name='send-assist-message' value='Send' class='btn' id='message-btn'>";
      echo "</form>";
    echo "</div>";
    echo "</div>";



  } else {
    echo  "<center>";
    echo  "<div class='container' style='display:none'>";
    echo  "<div class='message-wrapper'>";
    echo  "<div class='message-form'>";

    echo  "<center><br>";
    echo  "<form action='message.php' method='post'>";
    echo  "<textarea class='input'></textarea>";
    echo  "</div>";
    echo  "<div class='submit_field'>";
    echo  "<input type='submit' class='message-btn' name='send-message'>";
    echo  "</div>";
    echo  "</form>";
    echo "</div>";
    echo "</div>";

  }
}?>
</div>
  <!-- <br><br><br> -->
  <?php include "../templates/footer.php"?>
</body>
</html>
