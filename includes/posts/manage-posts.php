<?php 
$database = connecttoDB();
$sql = "SELECT * FROM posts";
  // 2.2
$query = $database->query( $sql );
  // 2.3
$query->execute();
  // 2.4
$posts = $query->fetchAll();

if ( !IsUserLoggedIn() ) {
    header("Location: /");
    exit;
  }

$loggedInUserId = $_SESSION['user']['id'];
$loggedInUserRole = $_SESSION['user']['role'];

?>

<?php require "parts/header.php"; ?>

    <div class="container mx-auto my-5" style="max-width: 700px;">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Manage Posts</h1>
        <div class="text-end">
          <a href="/manage-posts-add" class="btn btn-primary btn-sm"
            >Add New Post</a
          >
        </div>
      </div>
      <div class="card mb-2 p-4">
        <?php require "parts/message_success.php"; ?>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col" style="width: 40%;">Title</th>
              <th scope="col">Status</th>
              <th scope="col" class="text-end">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($posts as $index => $post) : ?>
            <?php if ($loggedInUserRole === 'editor' || $loggedInUserRole === 'admin' || $post['user_id'] == $loggedInUserId) : ?>
            <tr>
              <th scope="row"><?php echo $post['id'];?></th>
              <td><?php echo $post['title'];?></td>
              <?php if ( $post['status'] === 'Publish' ) : ?>
                <td><span class="badge bg-success"><?php echo $post['status']; ?></span></td>
              <?php endif; ?> 
              <?php if ( $post['status'] === 'Pending Review' ) : ?>
                <td><span class="badge bg-warning"><?php echo $post['status'];?></span></td>
              <?php endif; ?>
              <td class="text-end">
                <div class="buttons">
                  <?php if ( $post['status'] === 'Publish' ) : ?>
                    <a
                      href="/post "
                      target="_blank"
                      class="btn btn-primary btn-sm me-2 "
                      ><i class="bi bi-eye"></i
                    ></a>
                  <?php endif; ?> 
                  <?php if ( $post['status'] === 'Pending Review' ) : ?>
                    <a
                      href="/post "
                      target="_blank"
                      class="btn btn-primary btn-sm me-2 disabled"
                      ><i class="bi bi-eye"></i
                    ></a>
                  <?php endif; ?>
                  <a
                    href="/manage-posts-edit?id=<?php echo $post['id'];?> "
                    class="btn btn-secondary btn-sm me-2"
                    ><i class="bi bi-pencil"></i
                  ></a>
                  
                  <form method="POST" action="/deletepost" style="display: inline;">                    
                    <input type="hidden" name="user_id" value="<?= $post["id"]; ?>" />
                    <button class="btn btn-danger  btn-sm me-2"><i class="bi bi-trash "></i></button>
                  </form>                  
                </div>
              </td>
            </tr>
            <?php endif; ?>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <div class="text-center">
        <a href="/dashboard" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i> Back to Dashboard</a
        >
      </div>
    </div>

    <?php require "parts/footer.php"; ?>
