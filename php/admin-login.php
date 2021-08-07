<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../css/admin-login.css">
  </head>
  <body>
    <?php
      session_start();
      if(array_key_exists("visited", $_SESSION))
      {
        session_destroy();
      }
    ?>
    <div class="header">
      Admin Login
    </div>

    <hr><hr><hr>

    <div class="center">

      <h1>Login</h1>

      <form class="box" action="" method="post">

        <div class="txt_field">
          <input type="text" name="username" required>
          <span></span>
          <label>Username</label>
        </div>

        <div class="txt_field">
          <input type="password" name="password" required>
          <span></span>
          <label>Password</label>
        </div>

        <input type="submit" name="submit" value="Login">

      </form>

    </div>

    <a href="../index.php">
      <img src="../image/icon/exit.png" alt="">
    </a>

    <?php
    error_reporting(E_PARSE | E_ERROR);
    require("connect.php");

    $username = $_REQUEST["username"];
    $password = $_REQUEST["password"];

    $query = "SELECT * FROM admin WHERE username = '{$username}' AND password = '{$password}'";
    $result = mysqli_query($connection, $query);

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
      if(mysqli_num_rows($result) == 1)
      {
        session_start();
        $_SESSION["username"] = $username;
        header("Location: admin-page.php");
      }
      else
      {
        echo "<script> alert('Wrong username or password'); window.location = 'admin-login.php'; </script>";
      }
    }

    ?>

  </body>
</html>
