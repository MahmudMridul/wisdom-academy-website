<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
    crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/student-login.css">

    <title>Student-login</title>
  </head>
  <body>
    <?php
      session_start();
      if(array_key_exists("visited", $_SESSION))
      {
        session_destroy();
      }
    ?>

    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark nav-height">

      <div class="container-fluid">

        <a class="navbar-brand" href="../index.php">Wisdom Academy</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarNav" aria-controls="navbarNav"
        aria-expanded="false" aria-label="Toggle navigation">

          <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

          <ul class="navbar-nav">

            <li class="nav-item">
              <a class="nav-link nav-hov" aria-current="page" href="../index.php">Home</a>
            </li>

            <li class="nav-item">
              <a class="nav-link nav-hov" href="../about.html">About</a>
            </li>

            <li class="nav-item">
              <a class="nav-link nav-hov" href="work.php">Our Work</a>
            </li>

            <li class="nav-item">

              <div class="dropdown">
                <a class="nav-link dropdown-toggle nav-hov" href="#" role="button"
                id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                Our Team
                </a>

                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <li><a class="dropdown-item" href="team-core.php">Core</a></li>
                  <li><a class="dropdown-item" href="team-intern.php">Intern</a></li>
                </ul>
              </div>

            </li>

            <li class="nav-item">
              <a class="nav-link nav-hov" href="news.php">News</a>
            </li>

            <li class="nav-item">

              <div class="dropdown">
                <a class="nav-link dropdown-toggle nav-hov" href="#" role="button"
                id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                Exam Site
                </a>

                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <li><a class="dropdown-item" href="student-registration.php">Student Registration</a></li>
                  <li><a class="dropdown-item" href="student-login.php">Student Login</a></li>
                </ul>
              </div>

            </li>

            <li class="nav-item">
              <a class="nav-link nav-hov" href="../contact.html">Contact</a>
            </li>

            <li class="nav-item">
              <a class="nav-link nav-hov" href="admin-login.php">Admin Login</a>
            </li>

          </ul>
        </div>
      </div>

    </nav>

    <div class="my-grid">

      <div class="login_header">
          <h1>Student Login</h1>
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

    </div>

    <?php
    require("connect.php");

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
      $username = $_REQUEST["username"];
      $password = $_REQUEST["password"];

      $query = "SELECT * FROM student WHERE username = '{$username}' AND password = '{$password}'";
      $result = mysqli_query($connection, $query);

      if(mysqli_num_rows($result) == 1)
      {
        //session_start();
        $_SESSION["username"] = $username;
        header("Location: student-page.php");
      }
      else
      {
        echo "<script> alert('Wrong username or password'); window.location = 'student-login.php'; </script>";
      }
    }

    function console_log( $data ){
  echo '<script>';
  echo 'console.log('. json_encode( $data ) .')';
  echo '</script>';
}

    ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous">
    </script>

  </body>
</html>
