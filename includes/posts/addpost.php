<?php 


$database = connecttoDB();

$title = $_POST["title"];
$content = $_POST["content"];
$user_id = $_SESSION["user"]["id"];

if (
    empty($title) ||
    empty($content)
){
    $_SESSION["error"] = "All fields are required";
        header("Location: /manage-posts-add");
        exit;
} else {
     // 5. create a user account
    // 5.1 SQL command
    $sql = "INSERT INTO posts (`title`,`content`, `user_id`) VALUES (:title, :content, :user_id)";
    // 5.2 prepare
    $query = $database->prepare( $sql );
    // 5.3 execute
    $query->execute([
        "title" => $title,
        "content" => $content,
        "user_id" => $user_id
    ]);

    $_SESSION["success"] = "Post created succesfully.";

    header("Location: /manage-posts");
    exit;
}