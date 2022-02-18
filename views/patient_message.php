<?php
require_once "../controllers/authenticationControllers/signinaspatientController.php";
require_once "../controllers/messagingControllers/patientMessageController.php";
require_once "../controllers/messagingControllers/updateIfReadAndSelectMessageControllerPatientSide.php";
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
      <h1 class="logo-text"><a href="patientportal.php">E<span>ped</span>A</a></h1>
    </div>
    <ul class="nav">
      <li><a href="viewmedicalrecordpatientside.php?patrec=<?=$_SESSION['patientno']?>">View Record</a></li>
      <li><a href="uploadlabresultpatientside.php">Upload Laboratory Result</a></li>
      <li><a href="patient_message.php">Message</a></li>
      <li><a href="patientsportal.php?logout=1">Logout</a></li>
    </ul>
  </header>

  <div class="message-wrapper">

    <div class="parent-search">
      <div class="boxContainer">
        <table class="elementContainer">
          <tr>
              <form action="patient_message.php" method="POST">
             <td>
              <input type="text" placeholder="First Name" class="search" name="search_patfirstN" autocomplete="off">
            </td>
            <td>
              <input type="text" placeholder="Last Name" class="search" name="search_patlastN" autocomplete="off">
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
    include "../controllers/messagingControllers/SearchAndMessageControllerPatientSide.php";


     if ($result->num_rows ==  0)  {

       echo "<div class='no-record-warning'>";
       echo "<p>No records found <p>";
       echo "</div>";

     } else {

         $pt_Row = $result->fetch_assoc();

         $search_RecevID = $pt_Row['userToID'];
         //
         $search_RecevFN = $pt_Row['receiverFirstName'];
         //
         $search_RecevLN = $pt_Row['receiverLastName'];

         if(($search_FN_Patient = $search_RecevFN) && ($search_LN_Patient = $search_RecevLN)) {

         echo  "<div class='search-chat-form'>";
         echo  "<form action='patient_message.php' method='post'>";
               if(count($msg_error) > 0):
                 foreach($msg_error AS $msg_err):
                   echo $msg_err . "<br>";
                 endforeach;
               endif;
           echo "<input type='hidden' name='messageToID' value='". $search_RecevID . "'>";
           echo "<div class='message-div'>";
           echo  "<textarea class='input' name='patient-form-message' placeholder='Send message to " . $search_RecevFN . " " . $search_RecevLN . "..'></textarea>";
           echo "</div>";
           echo "<div class='send-div'>";
           echo  "<input type='submit' class='btn' name='patient-msg' value='Send' id='send-search'>";
           echo  "</div>";
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
        <h4><i>Pediatricians</i></h4>
      </div>
      <div class="users">
        <form method="POST">
           <p>Doctor<a href="patient_message.php?pediaID=<?= $pedia_ID_Patient ?>"> <?=  $pedia_First_Name . " " . $pedia_Last_Name ?></a></p>
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
        <h4><i>Doctor Assistants</i></h4>
      </div>
      <div class="users">
        <form method="POST">
           <p>Assistant <a href="patient_message.php?drAssistID=<?= $drAssist_ID_Patient ?>"> <?=  $drAssist_First_Name . " " . $drAssist_Last_Name ?></a></p>
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
  </div>
  <div class="chatbox">
    <div class="message-header">
      <center>
        <h4>My Messages</h4>
      </center>
    </div>
    <div class="chat-logs">
      <?php
      while ($row_msg = $result->fetch_assoc()) {
        $sender_id = $row_msg['userFrom'];
        $receiver_id = $row_msg['userTo'];
        $msg_content = $row_msg['message'];
        $msg_date_time = $row_msg['dateSent'];

      ?>
      <?php
          if (($patient_ID == $sender_id AND $pedia_ID_Patient == $receiver_id) && (isset($_GET['pediaID']))) {
              echo "
                <div class='chat patient'>
                 <p class='chat-message'>" . $msg_content . "</p>
                 <span class='time'>". "You" . "|" .  $msg_date_time ."</span>
                </div>
              ";
            }
          if (($patient_ID == $receiver_id AND  $pedia_ID_Patient ==  $sender_id) && (isset($_GET['pediaID']))) {
             echo "
               <div class='chat doctor'>
                <p class='chat-message'>" . $msg_content . "</p>
               <span class='time'>" . $pedia_First_Name . " " . $pedia_Last_Name . "|". $msg_date_time . "</span>
               </div>
             ";
         }
         if (($patient_ID == $sender_id AND $drAssist_ID_Patient == $receiver_id) && (isset($_GET['drAssistID']))) {
             echo "
               <div class='chat patient'>
                <p class='chat-message'>" . $msg_content . "</p>
               <span class='time'>" . "You" . "|". $msg_date_time . "</span>
               </div>
             ";
         }
         if (($patient_ID == $receiver_id && $drAssist_ID_Patient == $sender_id) && (isset($_GET['drAssistID']))) {
           echo "
           <div class='chat assistant'>
            <p class='chat-message'>" . $msg_content . "</p>
           <span class='time'>" . $drAssist_First_Name . " " . $drAssist_Last_Name . "|". $msg_date_time . "</span>
           </div>
           ";
         }
       }
      ?>
    </div>
    <?php
    if (isset($_GET['pediaID'])) {

       echo "<div class='chat-form'>";

       echo "<form action='patient_message.php' method='post'>";
           if(count($msg_error) > 0):
             foreach($msg_error AS $msg_err):
                 echo $msg_err . "<br>";
               endforeach;
             endif;
       echo "<textarea class='input' name='pedia-message' placeholder='Enter Message...'></textarea>";
       echo "<input type='submit' class='btn' name='send-pedia-message' value='Send' id='message-btn'>";
       echo "</form>";
       echo "</div>";
       echo "</div>";

    } else if (isset($_GET['drAssistID'])) {
      echo "<div class='chat-form'>";

      echo "<form action='patient_message.php' method='post'>";
          if(count($msg_error) > 0):
            foreach($msg_error AS $msg_err):
                echo $msg_err . "<br>";
              endforeach;
            endif;
      echo "<textarea class='input' name='message' placeholder='Enter Message...'></textarea>";
      echo "<input type='submit' class='btn' name='send-message' value='Send' id='message-btn'>";
      echo "</form>";
      echo "</div>";
      echo "</div>";
    } else {
      echo "<center>";
      echo "<div class='container' style='display:none'>";
      echo "<div class='message-wrapper'>";
      echo "<div class='message-form'>";
      echo "<center><br>";
      echo "<div class='chat-form'>";

      echo "<form action='patient_message.php' method='post'>";
          if(count($msg_error) > 0):
            foreach($msg_error AS $msg_err):
                echo $msg_err . "<br>";
              endforeach;
            endif;
      echo "<textarea class='input' name='message' placeholder='Enter Message...'></textarea>";
      echo "<input type='submit' class='btn' name='send-message' value='Send'>";
      echo "</form>";
      echo "</div>";
      echo "</div>";
      echo "</center>";
      echo "</div>";
      echo "</div>";
    }

    ?>

  <?php include "../templates/footer.php"?>
</body>
</html>
