<section class="d-flex justify-content-center align-items-center" style="height: 100vh;">
  <div class="rounded bg-ice text-white my-3 p-3" style="width: 29rem;">

    <h2 class="primary-title text-center">Add a New Book</h2>

    <div class="rounded p-3 bg-cream text-black">
      <form action="/dashboard/add-book" method="POST">

        <div class="mb-3">
          <label for="title" class="form-label">Book Title</label>
          <input type="text" name="title" class="form-control form-control-sm" id="title">
        </div>
        <div class="mb-3">
          <label for="author" class="form-label">Author</label>
          <input type="text" name="author" class="form-control form-control-sm" id="author">
        </div>
        <div class="mb-3">
          <label for="genre" class="form-label">Genre</label>
          <input type="text" name="genre" class="form-control form-control-sm" id="genre">
        </div>

        <hr>
        <div class="d-grid gap-2">
          <input class="btn btn-primary" type="submit" name="submit" value="Add a The New Book!">
        </div>
      </form>
    </div>

  </div>
</section>

<?php
require "./helper/db.php";

if (isset($_POST['submit'])) {
  $title = trim($_POST['title']);
  $author = trim($_POST['author']);
  $genre = trim($_POST['genre']);

  $db->exec("INSERT INTO book (title, author, genre) VALUES ('$title', '$author', '$genre');");
  header('location:/dashboard');
}


?>
