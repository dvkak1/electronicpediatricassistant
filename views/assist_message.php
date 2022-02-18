<?php

require_once "../controllers/messagingControllers/assist_message_controller.php";
require_once "../controllers/messagingControllers/updateIfReadAndSelectMessageControllerAssistSide.php";

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
      <h1 class="logo-text"><a href="index.php">E<span>ped</span>A</a></h1>
    </div>
    <ul class="nav">
      <li><a href="patientmedicalrecordsdrasstview.php">Medical Records</a></li>
      <li><a href="#">Government Links</a></li>
      <li><a href="assist_message.php">Message</a></li>
      <li><a href="../index.php?logout=1">Log out</a></li>
    </ul>
  </header>

  <div class="message-wrapper">

  <div class="parent-search">
    <div class="boxContainer">
      <table class="elementContainer">
        <tr>
            <form action="assist_message.php" method="POST">
           <td>
            <input type="text" placeholder="First Name" class="search" name="search_FN" autocomplete="off">
          </td>
          <td>
            <input type="text" placeholder="Last Name" class="search" name="search_LN" autocomplete="off">
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
     include "../controllers/messagingControllers/searchMessageControllerAssistantSide.php";


      // if ($row_count->num_rows ==  0)  {
      if ($result->num_rows == 0) {


        echo "<div class='no-record-warning'>";
        echo "<p>No records found <p>";
        echo "</div>";

      }  else   {
        //
        // $dA_Row = $row_count->fetch_assoc();
        $dA_Row = $result->fetch_assoc();


        $search_RecevID = $dA_Row['userToID'];
        //
        $search_RecevFN = $dA_Row['receiverFirstName'];
        //
        $search_RecevLN = $dA_Row['receiverLastName'];

        if(($byDA_FN = $search_RecevFN) && ($byDA_LN = $search_RecevLN)) {

        echo  "<div class='search-chat-form'>";
        echo  "<form action='assist_message.php' method='post'>";

          echo "<input type='hidden' name='messageToID' value='". $search_RecevID . "'>";
          echo  "<textarea class='input' name='assist-form-message' placeholder='Send message to " . $search_RecevFN . " " . $search_RecevLN . "..'></textarea>";
          echo  "<input type='submit' class='btn' name='assist-to-user-search' value='Send' id='send-search'>";
          echo  "</div>";
          echo  "</form>";
          // echo "</div>";

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
                <p>Doctor<a href="assist_message.php?pediaID=<?= $pedID ?>"> <?=  $pedFirstName . " " . $pedLastName ?></a></p>
                <?php if ($row_total_2 > 0)  {
                 echo   " " . "<p style='color:red'> ".  $row_total_2. " message(s)</p>&nbsp;&nbsp";
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
             <h4><i>Patients</i></h4>
           </div>
           <div class="users">
          <form method="POST">
              <p>Patient <a href="assist_message.php?patientID=<?= $patientID ?>"><?=  $patientFN . " " . $patientLN ?></a></p>
                <?php if ($row_total > 0)  {
                echo " " . "<p style='color:red'>" . $row_total. " message(s)</p>&nbsp;&nbsp";
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
             while ($row_msg = $result_asst->fetch_assoc()) {
               $sender_id = $row_msg['userFrom'];
               $receiver_id = $row_msg['userTo'];
               $msg_content = $row_msg['message'];
               $msg_date_time = $row_msg['dateSent'];

             ?>
             <?php
               if (($asstID == $sender_id AND $patientID == $receiver_id) && (isset($_GET['patientID']))) {

                   echo "
                   <div class='chat assistant'>
                     <p class='chat-message'>" .$msg_content . "</p>
                    <span class='time'>". "You " . "|" . $msg_date_time . "</span>
                   </div>";

               } else if (($asstID == $receiver_id AND $patientID  == $sender_id) && (isset($_GET['patientID'])) ) {


                  echo "
                      <div class='chat patient'>
                       <p class='chat-message'>". $msg_content. "</p>
                      <span class='time'>". $patientFN . " " . $patientLN . " " .  "|" . $msg_date_time . "</span>" .
                      "</div>";


               } else if (($asstID == $sender_id AND $pedID == $receiver_id) && (isset($_GET['pediaID']))) {
                 echo "
                 <div class='chat assistant'>
                   <p class='chat-message'>" .$msg_content . "</p>
                  <span class='time'>". "You ". "|" . $msg_date_time . "</span>
                 </div>";

               } else if (($asstID == $receiver_id AND $pedID == $sender_id) && (isset($_GET['pediaID']))) {
                 echo "
                        <div class='chat doctor'>
                        <p class='chat-message'>". $msg_content . "</p>
                        <span class='time'>". $pedFirstName . " ".  $pedLastName . "|" . $msg_date_time . "</span>
                        </div>";
               }
         }
         ?>
           </div>
           <?php
               if (isset($_GET['patientID'])) {
               echo "<div class='chat-form'>";
               echo "<form action='assist_message.php' method='POST'>";
                   echo "<textarea class='input' name='message'></textarea>";
                   echo "<input type='submit' name='send-patient-message' value='Send' class='btn' id='message-btn'>";
                 echo "</form>";
               echo "</div>";
               echo "</div>";



             }  else if (isset($_GET['pediaID'])){
               echo "<div class='chat-form'>";
               echo "<form action='assist_message.php' method='POST'>";
                   echo "<textarea class='input' name='message'></textarea>";
                   echo "<input type='submit' name='send-pediatrician-message' value='Send' class='btn' id='message-btn'>";
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

             }?>
           </div>
         </div>
</div>
  <?php include "../templates/footer.php"?>
</body>
</html>
