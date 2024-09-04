<?php
 // start session
 session_start();

// 1. collect database info
$host = "localhost";
$database_name = "classroom_management";
$database_user = "root";
$database_password = "pass123";

  // 2. connect to database (PDO - PHP database object)
  $database = new PDO(
    "mysql:host=$host;dbname=$database_name",
    $database_user, // username
    $database_password // password
  );



 // 3. get all the data from the login page form
 $email = $_POST['email'];
 $password = $_POST['password'];

 // 4. check for error (make sure all fields are filled)
 if ( empty( $email ) || empty( $password ) ) {
     echo "All fields are required";
 } else {
     // 5. check if the email entered is in the system or not
     // 5.1 sql command
     $sql = "SELECT * FROM users WHERE email = :email";
     // 5.2 prepare
     $query = $database->prepare($sql);
     // 5.3 execute
     $query->execute([
         'email' => $email
     ]);
     // 5.4 fetch
     $user = $query->fetch(); // return the first row of the list
     
     // check if user exists
     if ( $user ) {
         // 6. check if the password is correct or not
         if ( password_verify( $password, $user["password"] ) ) {
             // 7. login the user (you want to store the data in the browser)
             $_SESSION['user'] = $user;

             // 8. redirect the user back to index.php
             header("Location: index.php");
             exit;
         } else {
             echo "The password provided is incorrect";   
         }
     } else {
         echo 'The email provided does not exist';
     }

 }