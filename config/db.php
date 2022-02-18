<?php

require 'constants.php';

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
  die('Database error: ' . $conn->connect_error);
  // echo "Connected to database.";
}


// function selectAll($table)
// {
//  global $conn;
//  $sql = 'SELECT * FROM $table';
//  $stmt = $conn->prepare($sql);
//  $stmt->execute();
//  $records = $stmt->get_result()->fetch_assoc(MYSQLI_ASSOC);
//  return $records;
// }
//
// $users = selectAll('specialization');
?>
