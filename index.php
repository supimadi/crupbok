<?php

  session_start();
  require "./helper/db.php";
  require "./helper/createTable.php";

  createTable();

  $url_path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

  function render($title, $template)
  {

    if($template == "")
      throw new Exception("MUST provide template.");

    require "./pages/base.php";
  }

  function loginCheck()
  {
    if (!($_SESSION["isLogin"])) {
      header('location:/');
    }
  }

  switch ($url_path) {
    // HOME (INDEX) URL
    case "/":
        render("Crupbok | CRUD PHP Book", "./pages/home.php");
        break;

    // AUTH URLS
    case "/register":
        render("Register | Crupbok", "./pages/register.php");
        break;
    case "/logout":
        $_SESSION["isLogin"] = false;
        header('location:/');
        break;

    // DASHBOARD URLS
    case "/dashboard":
        loginCheck();
        render("Dashboard | Crupbok", "./pages/dashboard.php");
        break;
    case "/dashboard/add-book":
        loginCheck();
        render("Add Book | Crupbok", "./pages/add-book.php");
        break;
    case "/dashboard/update-book":
        loginCheck();
        render("Add Book | Crupbok", "./pages/update-book.php");
        break;
    case "/dashboard/delete-book":
        loginCheck();
        $id =  $_GET["id"];
        $db->exec("DELETE FROM book WHERE book_id=$id");
        header("location:/dashboard");
        break;

    // FALLBACK
    default:
        require "./pages/404.php";
        break;
  }
