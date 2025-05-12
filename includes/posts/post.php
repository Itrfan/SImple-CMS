<?php 
  // connect to database
  $database = connectToDB();

  // get the id from the URL /manage-users-edit?id=1
  $id = $_GET["id"];

  // load the user data by id
  // SQL
  $sql = "SELECT * FROM posts WHERE id = :id";
  // prepare
  $query = $database->prepare( $sql );
  // execute
  $query->execute([
    "id" => $id
  ]);
  // fetch
  $post = $query->fetch(); // get only the first row of the match data

require "parts/header.php"; 
?>

    <div class="container mx-auto my-5" style="max-width: 500px;">
      <h1 class="h1 mb-4 text-center"><?php echo $post["title"]; ?></h1>
      <p>
        <?php echo $post["content"]; ?>
      </p>
      <div class="text-center mt-3">
        <a href="/" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i> Back</a
        >
      </div>
    </div>

    <?php require "parts/footer.php"; ?>
