<?php
  require "./helper/db.php";

  $id = $_GET["id"];
  $res = $db->query("SELECT * FROM book WHERE book_id = '$id';");
  $res = $res->fetchArray(SQLITE3_ASSOC);

?>

<section class="d-flex justify-content-center align-items-center" style="height: 100vh;">
  <div class="rounded bg-ice text-white my-3 p-3" style="width: 29rem;">

    <h2 class="primary-title text-center">Add a New Book</h2>

    <div class="rounded p-3 bg-cream text-black">
      <form action="/dashboard/update-book" method="POST">
        <input type="hidden" name="id" value="<?php echo $res['book_id']; ?>">

        <div class="mb-3">
          <label for="title" class="form-label">Book Title</label>
          <input type="text" name="title" class="form-control form-control-sm" id="title" value="<?php echo $res['title']; ?>">
        </div>
        <div class="mb-3">
          <label for="author" class="form-label">Author</label>
          <input type="text" name="author" class="form-control form-control-sm" id="author" value="<?php echo $res['author']; ?>">
        </div>
        <div class="mb-3">
          <label for="genre" class="form-label">Genre</label>
          <input type="text" name="genre" class="form-control form-control-sm" id="genre" value="<?php echo $res['genre']; ?>">
        </div>

        <hr>
        <div class="d-grid gap-2">
          <input class="btn btn-primary" type="submit" name="submit" value="Update The Book!">
        </div>
      </form>
    </div>

  </div>
</section>

<?php
require "./helper/db.php";

if (isset($_POST['submit'])) {
  $id = trim($_POST['id']);
  $title = trim($_POST['title']);
  $author = trim($_POST['author']);
  $genre = trim($_POST['genre']);

  $db->exec("UPDATE book SET title='$title', author='$author', genre='$genre' WHERE book_id=$id");
  header('location:/dashboard');
}

?>
