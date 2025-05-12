<?php

    // 1. Connect to DB
    $database = connectToDB();

    // 2. get the data from the form
    $id = $_POST["id"];
    $title = $_POST["title"];
    $content = $_POST["content"];
    $status = $_POST["status"];

    // 3. check error
    if (  empty( $title ) || empty( $content ) || empty( $status )) {
        $_SESSION["error"] = "Please fill up all the fields";
        header("Location: /manage-posts-edit?id=" . $id );
        exit;
    } 

    // 4. update user
    $sql = "UPDATE posts set title = :title, content = :content, status = :status WHERE id = :id";
    $query = $database->prepare( $sql );
    $query->execute([
        "title" => $title,
        "content" => $content,
        "status" => $status,
        "id" => $id
    ]);

    // 5. redirect 
    $_SESSION["success"] = "Post has been updated";
    header("Location: /manage-posts" );
    exit;