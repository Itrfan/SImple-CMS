<?php 
  session_start();
  require "includes/function.php";
  



  $path = $_SERVER["REQUEST_URI"];
  $path = parse_url( $path, PHP_URL_PATH );

  switch ($path) {
    case '/login':
      require "pages/login.php";
      break;
    case '/signup':
      require "pages/signup.php"; 
      break;
    case '/logout':
      require "pages/logout.php";
      break;
    case '/dashboard':
      require "pages/dashboard.php";
      break;
    //action routes
    case '/post':
      require "includes/posts/post.php";
      break;
    case '/manage-users':
      require "includes/users/manage-users.php";
      break;
    case '/manage-users-add':
      require "includes/users/manage-users-add.php";
      break;
    case '/manage-users-edit':
      require "includes/users/manage-users-edit.php";
      break;
    case '/manage-users-changepwd':
      require "includes/users/manage-users-changepwd.php";
      break;
    case '/manage-posts':
      require "includes/posts/manage-posts.php";
      break;
    case '/manage-posts-add':
      require "includes/posts/manage-posts-add.php";
      break;
    case '/manage-posts-edit':
      require "includes/posts/manage-posts-edit.php";
      break;

     case '/auth/login':
      require "includes/auth/do_login.php";
      break;
    case '/auth/signup':
      require "includes/auth/do_signup.php";
      break;

    case '/add':
      require "includes/users/add.php";
      break;
    
    case '/delete':
      require "includes/users/delete.php";
      break;
    case '/update':
      require "includes/users/update.php";
      break;
    case '/change':
      require "includes/users/changepwd.php";
      break;

    case '/addpost':
      require "includes/posts/addpost.php";
      break;

    case '/deletepost':
      require "includes/posts/deletepost.php";
      break;

    case '/updatepost':
      require "includes/posts/updatepost.php";
      break;
      
    default:
      require "pages/home.php";
      break;
     };

