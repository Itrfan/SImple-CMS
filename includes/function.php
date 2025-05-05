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
