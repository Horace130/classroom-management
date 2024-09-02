<?php

$host = "localhost";
$database_name = "classroom_management";
$database_user = "root";
$database_password = "pass123";

  $database = new PDO(
    "mysql:host=$host;dbname=$database_name",
    $database_user, // username
    $database_password // password
  );

  $id = $_POST["student_id"];

  // delete the selected student from the table using student ID
  // sql command (recipe)
  $sql = "DELETE FROM students where id = :id";
  // prepare 
  $query = $database->prepare( $sql );
  // execute
  $query->execute([
      'id' => $id
  ]);

  // redirect back to index.php
  header("Location: index.php");
  exit;