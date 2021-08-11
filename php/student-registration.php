<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
    crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/student-registration.css">

    <title>Student-Registration</title>
  </head>
  <body>

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
                Student
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
          <h1>Register Here</h1>
      </div>

        <div class="login_form">
          <form class="box" action="" method="post">

            <div class="txt_field">
              <label>Name</label> <br>
              <input type="text" name="name" required>
            </div>

            <div class="txt_field">
              <label>E-mail</label> <br>
              <input type="email" name="email" required>
            </div>

            <div class="txt_field">
              <label>Facebook Account Link</label> <br>
              <input type="text" name="fb_link" required>
            </div>

            <div class="txt_field">
              <label>Username</label> <br>
              <input type="text"  name="username" required>
            </div>

            <div class="txt_field">
              <label>Password</label> <br>
              <input type="password" name="password" required>
            </div>

            <br>

            <input type="submit" value="Register">

          </form>
        </div>

    </div>

    <?php
    error_reporting(E_PARSE | E_ERROR);
    require("connect.php");

    $name = $_REQUEST["name"];
    $email = $_REQUEST["email"];
    $fb_link = $_REQUEST["fb_link"];
    $username = $_REQUEST["username"];
    $password = $_REQUEST["password"];

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
      if(preg_match("/^[a-zA-Z-' ]*$/", $name))
      {
        if(filter_var($email, FILTER_VALIDATE_EMAIL))
        {
          if(preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$fb_link))
          {
            if(strlen($username)<=20)
            {
              $query = "SELECT * FROM student WHERE username = '{$username}'";
              $result = mysqli_query($connection, $query);

              if(mysqli_num_rows($result) == 0)
              {
                if(validPassword($password))
                {
                  $query = "INSERT INTO student (name, email, fb, username, password) VALUES ('$name','$email','$fb_link','$username','$password')";
                  $result = mysqli_query($connection, $query);
                  echo "<script> alert('Registration Successfull!'); window.location = 'student-registration.php'; </script>";
                }
              }
              else
              {
                echo "<script> alert('This username is not available.'); window.location = 'student-registration.php'; </script>";
              }
            }
            else
            {
              echo "<script> alert('Username is too long. Maximum 20 characters allowed.'); window.location = 'student-registration.php'; </script>";
            }
          }
          else
          {
            echo "<script> alert('Invalid facebook link!'); window.location = 'student-registration.php'; </script>";
          }

        }
        else
        {
          echo "<script> alert('Invalid email!'); window.location = 'student-registration.php'; </script>";
        }
      }
      else
      {
        echo "<script> alert('Invalid name!'); window.location = 'student-registration.php'; </script>";
      }

    }

    function validPassword($pwd)
    {
      if (strlen($pwd) >= 8 && strlen($pwd) <= 20)
      {
        if (preg_match("#[0-9]+#", $pwd))
        {
          if (preg_match("#[a-zA-Z]+#", $pwd))
          {
            return true;
          }
          else
          {
            echo "<script> alert('Password must contain letters'); window.location = 'student-registration.php'; </script>";
            return false;
          }
        }
        else
        {
          echo "<script> alert('Password must contain numbers'); window.location = 'student-registration.php'; </script>";
          return false;
        }
      }
      else
      {
        echo "<script> alert('Password must be at least 8 characters and not more than 20'); window.location = 'student-registration.php'; </script>";
        return false;
      }

    }

    ?>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous">
    </script>

  </body>
</html>
