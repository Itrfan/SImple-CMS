<?php

function connecttoDB() {
    
$host = "127.0.0.1";
$database_name = "simple_CMS";
$database_user = "root";
$database_password = "";


// 2. connect PHP with the MySQL database
//PDO (PHP Database Object)
$database = new PDO("mysql:host=$host;dbname=$database_name", 
$database_user, 
$database_password);

return $database;
};


function getUserByEmail( $email ) {
    $database = connecttoDB();

    $sql = "SELECT * FROM users WHERE email = :email";

    $query = $database->prepare( $sql );

    $query->execute([
        "email" => $email,
    ]);
    $user = $query->fetch();

    return $user;
}

function IsUserLoggedIn(){
    return isset( $_SESSION["user"]);
}


function isAdmin() {
    // check if user session is set or not
    if ( isset( $_SESSION["user"] ) ) {
        // check if user is an admin
        if ( $_SESSION["user"]['role'] === 'admin' ) {
            return true;
        } 
    } 
    return false;
}

/* 
    check if current user is an editor or admin
*/
function isEditor() {
    return isset( $_SESSION["user"] ) && ( $_SESSION["user"]['role'] === 'admin' || $_SESSION["user"]['role'] === 'editor' ) ? true : false;
}

