<?php

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

    // 3. get all the data from the sign-up page form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    // var_dump($name);
    // var_dump($email);
    // var_dump($password);
    // var_dump($confirm_password);


    // 4. check for error (make sure all fields are filled)
    if ( empty( $name ) || empty( $email ) || empty( $password ) || empty( $confirm_password ) ) {
        echo "All the fields are required";
    } else if ( $password !== $confirm_password ) {
        echo "The password is not match";
    } else if ( strlen( $password ) < 8 ) { // check for the password length (make sure it's at least 8 characters)
        echo 'Your password must be at least 8 characters';
    } else {
        // 5. create a user account
        // sql command 
        $sql = "INSERT INTO users (`name`,`email`,`password`) VALUES (:name, :email, :password)";
        // prepare
        $query = $database->prepare( $sql );
        // execute
        $query->execute([
            'name' => $name,
            'email' => $email,
            // 'password' => $password
            'password' => password_hash($password, PASSWORD_DEFAULT)

        ]);

        // redirect to login.php
        header("Location: login.php");
        exit;
    }


?>