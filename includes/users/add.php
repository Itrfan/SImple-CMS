<?php

    // TODO: 1. connect to database
    $database = connecttoDB();
    
    // TODO: 2. get all the data from the form using $_POST
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = isset($_POST["password"]) ? $_POST["password"] : ""; 
    $confirm_password = isset($_POST["confirm-password"]) ? $_POST["confirm-password"] : ""; 
    $role = isset($_POST["role"]) ? $_POST["role"] : ""; 
    /*
        TODO: 3. error checking
        - make sure all the fields are not empty
        - make sure the password is match
        - make sure the email provided does not exist in the system
    */
    if ( 
        empty( $name ) || 
        empty( $email ) || 
        empty( $password ) || 
        empty( $confirm_password ) ||
        empty( $role )
    ) {
        $_SESSION["error"] = "All fields are required";
        header("Location: /manage-users-add");
        exit;
    } else if ( $password !== $confirm_password ){
        $_SESSION["error"] = "Password is not match";
        header("Location: /manage-users-add");
        exit;
    } else {
        $user = getUserByEmail( $email );
        if ($user){
            $_SESSION["error"] = "User already exist";
            header("Location: /manage-users-add");
            exit;
        } 
    }
            // 5. create a user account
        // 5.1 SQL command
        $sql = "INSERT INTO users (`name`,`email`, `role`, `password`) VALUES (:name, :email, :role, :password )";
        // 5.2 prepare
        $statement = $database->prepare( $sql );
        // 5.3 execute
        $statement->execute([
            "name" => $name,
            "role" => $role,
            "email" => $email,
            "password" => password_hash( $password, PASSWORD_DEFAULT )
        ]);

        $_SESSION["success"] = "Account created succesfully.";
    
    header("Location: /manage-users");
    exit;
        
    
