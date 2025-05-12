<?php

    $database = connecttoDB();


    // 3. get the data from the sign up form
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // 4. check for error
    if ( 
        empty( $name ) || 
        empty( $email ) || 
        empty( $password ) || 
        empty( $confirm_password ) 
    ) {
        $_SESSION["error"] = "All fields are required";
        header("Location: /signup");
        exit;
    } else if ( $password !== $confirm_password ) {
        $_SESSION["error"] = "The password is not the same";
        header("Location:/signup");
        exit;
    } else {
        // 5. create a user account
        // 5.1 SQL command
        $sql = "INSERT INTO users (`name`,`email`,`password`) VALUES (:name, :email, :password)";
        // 5.2 prepare
        $query = $database->prepare( $sql );
        // 5.3 execute
        $query->execute([
            "name" => $name,
            "email" => $email,
            "password" => password_hash( $password, PASSWORD_DEFAULT )
        ]);

        $_SESSION["success"] = "Account created succesfully. Please login to your newly created account.";

        // 6. redirect to login.php
        header("Location: /login");
        exit;
    }