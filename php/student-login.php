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
                  <li><a class="dropdown-item" href="#">Student Registration</a></li>
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
          <form class="box" action="index.php" method="post">

            <div class="txt_field">
              <input type="text" required>
              <span></span>
              <label>Username</label>
            </div>

            <div class="txt_field">
              <input type="password" required>
              <span></span>
              <label>Password</label>
            </div>

            <input type="submit" value="Login">

          </form>
        </div>

    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous">
    </script>

  </body>
</html>
