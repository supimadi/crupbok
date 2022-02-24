<section class="d-flex justify-content-center align-items-center" style="height: 100vh;">
  <div class="rounded bg-ice text-white my-3 p-3" style="width: 29rem;">

    <h2 class="primary-title text-center">Welcome to Crupbok</h2>
    <p class="text-center">Please login to continue or register <a class="link-light" href="/register">here</a>.</p>

    <?php
      if (isset($_COOKIE["user_exists"])){
        if ($_COOKIE["user_exists"] < 0) {
          require "./pages/error_alert.php";
          renderText("Username dan Password tidak valid!");
        }
      }
    ?>

    <div class="rounded p-3 bg-cream text-black">
      <form action="/" method="POST">
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" name="username" class="form-control form-control-sm" id="username">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" name="password" class="form-control form-control-sm" id="password">
        </div>
        <hr>
        <div class="d-grid gap-2">
          <input class="btn btn-primary" name="submit" value="Login" type="submit"/>
        </div>
      </form>
    </div>

  </div>
</section>

<?php
require "./helper/db.php";

setcookie("user_exists", 1);

if (isset($_POST['submit'])) {
  $username = trim($_POST['username']);
  $password = sha1(trim($_POST['password']));

  $res = $db->query("SELECT username FROM users WHERE username = '$username' AND password = '$password';");

  if ($res->fetchArray()) {
    setcookie("user_exists", 1);
    $_SESSION["isLogin"] = true;
    header('location:/dashboard');
  } else {
    setcookie("user_exists", -1);
    $_SESSION["isLogin"] = false;
    header('location:/');
  }

}
?>
