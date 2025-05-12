<?php 
$database = connecttoDB();
$sql = "SELECT * FROM posts";
  // 2.2
$query = $database->query( $sql );
  // 2.3
$query->execute();
  // 2.4
$posts = $query->fetchAll();

?>
<?php require "parts/header.php"; ?>

    <div class="container mx-auto my-5" style="max-width: 500px;">
      
      <h1 class="h1 mb-4 text-center">My Blog</h1>
      <?php foreach ($posts as $index => $post) : ?>
      <div class="card mb-2">
        <div class="card-body">
          <h5 class="card-title"><?php echo $post['title'];?></h5>
          <p class="card-text"><?php echo $post['content'];?></p>
          <div class="text-end">
            <a href="/post?id=<?php echo $post['id'];?>" class="btn btn-primary btn-sm">Read More</a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
      



      <div class="mt-4 d-flex justify-content-center gap-3">
      <?php if (IsUserLoggedIn()) : ?>
        <a href="/logout" class="btn btn-link btn-sm">Logout</a>
        <a href="/dashboard" class="btn btn-link btn-sm">Dashboard</a>
      <?php else : ?>
        <a href="/login" class="btn btn-link btn-sm">Login</a>
        <a href="/signup" class="btn btn-link btn-sm">Sign Up</a>

      <?php endif ; ?>
      </div>
    </div>
    <?php require "parts/footer.php"; ?>