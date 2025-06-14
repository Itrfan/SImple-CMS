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

  /*
    name -> $user["name"]
    email -> $user["email"]
    role -> $user["role"]
  */
  if ( !IsUserLoggedIn() ) {
    header("Location: /");
    exit;
  }
?>


<?php require "parts/header.php"; ?>

    <div class="container mx-auto my-5" style="max-width: 700px;">

      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Edit Post</h1>
      </div>
      <div class="card mb-2 p-4">
      <?php require ("parts/message_error.php"); ?>
        <form method="POST" action="/updatepost">
          <div class="mb-3">
            <label for="post-title" class="form-label">Title</label>
            <input
              type="text"
              class="form-control"
              id="post-title"
              value="<?php echo $post["title"]; ?>"
              name="title"
            />
          </div>
          <div class="mb-3">
            <label for="post-content" class="form-label">Content</label>
            <textarea class="form-control" id="post-content" rows="10" name="content"><?php echo $post["content"]; ?></textarea>
          </div>
          <div class="mb-3">
            <label for="post-content" class="form-label">Status</label>
            <select class="form-control" id="post-status" name="status">
              <option value="Publish" <?php echo ( $post["status"] === "Publish" ? "selected" : "" ); ?>>Publish</option>
              <option value="Pending Review" <?php echo ( $post["status"] === "Pending Review" ? "selected" : "" ); ?>>Pending Review</option>
            </select>
          </div>
          <div class="text-end">
            <input type="hidden" name="id" value="<?php echo $post["id"]; ?>"/>
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
      <div class="text-center">
        <a href="/manage-posts" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i> Back to Posts</a
        >
      </div>
    </div>

    <?php require "parts/footer.php"; ?>

