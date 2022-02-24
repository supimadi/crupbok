<section class="d-flex justify-content-center align-items-center" style="height: 100vh;">
  <div class="rounded bg-ice text-white my-3 p-3" style="width: 29rem;">

    <h2 class="primary-title text-center">Register to Crupbok</h2>

    <?php
      if (isset($_COOKIE["user_exists"])){
        if ($_COOKIE["user_exists"] < 0) {
          require "./pages/error_alert.php";
          renderText("Username already exist!");
        }
      }
    ?>

    <div class="rounded p-3 bg-cream text-black">
      <form action="/register" method="POST" name="registerForm" onsubmit="return validateForm()">
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" name="username" class="form-control form-control-sm" id="username">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" name="password" class="form-control form-control-sm" id="password">
        </div>
        <div class="mb-3">
          <label for="password2" class="form-label">Confirm Password</label>
          <input type="password" name="password2" class="form-control form-control-sm" id="password2">
        </div>
        <hr>
        <div class="d-grid gap-2">
          <input class="btn btn-primary" type="submit" name="submit" value="Register Me!">
        </div>
      </form>
    </div>

  </div>
</section>

<script type="text/javascript">
  let validateForm = () => {

    let password = document.forms["registerForm"]["password"].value;
    let password2 = document.forms["registerForm"]["password2"].value;
    let username = document.forms["registerForm"]["username"].value;
    let regex = /^[a-zA-Z0-9]+([_ -]?[a-zA-Z0-9])*$/;

    if (password2 != password) {
      alert("Password Tidak Sama");
      return false;
    }

    if (!(regex.test(username))) {
      alert("Username tidak valid, (hanya gunakan alphabet dan angka).");
      return false;
    }

  }
</script>

<?php
require "./helper/db.php";

setcookie("user_exists", 1);

if (isset($_POST['submit'])) {
  $username = trim($_POST['username']);
  $password = sha1(trim($_POST['password']));

  $res = $db->query("SELECT username FROM users WHERE username = '$username';");

  if ($res->fetchArray()) {
    setcookie("user_exists", -1);
    header('location:/register');
  } else {
    $db->exec("INSERT INTO users (username, password) VALUES ('$username', '$password');");
    header('location:/');

  }

}


?>
