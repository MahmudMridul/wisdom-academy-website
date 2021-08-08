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

    <div class="my-grid">

      <div class="login_header">
          <h1>Admin Login</h1>
      </div>

      <div class="login_form">
        <form class="box" action="" method="post">

          <div class="txt_field">
            <label>Username</label> <br>
            <input type="text" name="username" required>
          </div>

          <div class="txt_field">
            <label>Password</label> <br>
            <input type="password" name="password" required>
          </div>

          <br>

          <input type="submit" value="Login">

        </form>
      </div>

      <a href="../index.php" class="exit">
        <img src="../image/icon/exit.png" alt="">
      </a>

    </div>




    <?php
    require("connect.php");

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {

      $username = $_REQUEST["username"];
      $password = $_REQUEST["password"];

      $query = "SELECT * FROM admin WHERE username = '{$username}' AND password = '{$password}'";
      $result = mysqli_query($connection, $query);

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
