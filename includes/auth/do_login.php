<?php
    // start session (we want to use $_SESSION in this page)

    $database = connecttoDB();

    // 3. get all the data from the login page form
    $email = $_POST["email"];
    $password = $_POST["password"];

    // 4. check for error (make sure all the fields are filled)
    if ( empty( $email ) || empty( $password ) ) {
        $_SESSION["error"] = "All fields are required";
        header("Location: /login");
    } else {
        $user = getUserByEmail($email);
        // check if the user exists
        if ( $user ) {
            // 6. check if the password is correct or not
            if ( password_verify( $password, $user["password"] ) ) {
                // 7. store the user data in the session storage to login the user
                $_SESSION["user"] = $user;

                $_SESSION["success"] = "Welcome back, " . $user["name"] . "!";

                // 8. redirect the user back to index.php
                header("Location: /dashboard");
                exit;
            } else {
                $_SESSION["error"] = "The password provided is incorrect";
                header("Location:/login");
                exit;
            }
        } else {
            $_SESSION["error"]  = "The email provided does not exist";
            header("Location: /login");
            exit;
        }

    }