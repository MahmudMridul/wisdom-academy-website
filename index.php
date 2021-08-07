<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
	   <meta name="viewport" content="width=device-width, initial-scale=1">

     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
     rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
     crossorigin="anonymous">
     <link rel="stylesheet" href="css/style.css">

    <title>Wisdom Academy</title>

  </head>

  <body>

      <div class="progress-bar" id="scrollBar"></div>

      <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark nav-height">

        <div class="container-fluid">

          <a class="navbar-brand" href="index.php">Wisdom Academy</a>

          <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
          data-bs-target="#navbarNav" aria-controls="navbarNav"
          aria-expanded="false" aria-label="Toggle navigation">

            <span class="navbar-toggler-icon"></span>

          </button>

          <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav">

              <li class="nav-item">
                <a class="nav-link nav-hov" aria-current="page" href="index.php">Home</a>
              </li>

              <li class="nav-item">
                <a class="nav-link nav-hov" href="about.html">About</a>
              </li>

              <li class="nav-item">
                <a class="nav-link nav-hov" href="php/work.php">Our Work</a>
              </li>

              <li class="nav-item">

                <div class="dropdown">
                  <a class="nav-link dropdown-toggle nav-hov" href="#" role="button"
                  id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                  Our Team
                  </a>

                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <li><a class="dropdown-item" href="php/team-core.php">Core</a></li>
                    <li><a class="dropdown-item" href="php/team-intern.php">Intern</a></li>
                  </ul>
                </div>

              </li>

              <li class="nav-item">
                <a class="nav-link nav-hov" href="php/news.php">News</a>
              </li>

              <li class="nav-item">

                <div class="dropdown">
                  <a class="nav-link dropdown-toggle nav-hov" href="#" role="button"
                  id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                  Exam Site
                  </a>

                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <li><a class="dropdown-item" href="#">Registration</a></li>
                    <li><a class="dropdown-item" href="php/student-login.php">Student Login</a></li>
                    <li><a class="dropdown-item" href="#">Exam</a></li>
                  </ul>
                </div>

              </li>

              <li class="nav-item">
                <a class="nav-link nav-hov" href="contact.html">Contact</a>
              </li>

              <li class="nav-item">
                <a class="nav-link nav-hov" href="php/admin-login.php">Admin Login</a>
              </li>

            </ul>
          </div>
        </div>

      </nav>

      <div class="mother">

        <div class="welcome-text">
            WELCOME TO <br>
            WISDOM ACADEMY
        </div>

        <div class="quote">
          "Failure is the opportunity to begin again more intelligently." <br>
          -Henry Ford
        </div>

        <div class="current_event">
          <h1>Current Events</h1>

          <div class="current_event_grid">
            <?php
              require("php/connect.php");

              $query = "SELECT directory FROM current_event";
              $result = mysqli_query($connection, $query);

              if(mysqli_num_rows($result) > 0)
              {
                  while($row = mysqli_fetch_assoc($result))
                  {
                      echo "<img src=" . "'" . $row['directory']. "'"  ." class='images'>";
                  }
              }
              else
              {
                  echo "<h2> Currently there are no event </h2>";
              }


              mysqli_close($connection);
            ?>
          </div>

        </div>

        <div class="upcoming_event">
          <h1>Upcoming Events</h1>

          <div class="upcoming_event_grid">
            <?php
              require("php/connect.php");

              $query = "SELECT directory FROM upcoming_event";
              $result = mysqli_query($connection, $query);

              if(mysqli_num_rows($result) > 0)
              {
                  while($row = mysqli_fetch_assoc($result))
                  {
                      $dir = $row['directory'];
                      $directory = substr($dir, 4);
                      echo "<img src = 'image/current_event/facebook.png' class = 'imgages'> ";
                      echo "<img src=" . "'" . $directory . "'"  ." class='images'>";
                  }
              }
              else
              {
                  echo "<h2> Currently there are no event </h2>";
              }

              mysqli_close($connection);
            ?>
          </div>

        </div>

        <div class="foot">
          KUET Road, Khulna, Khulna Division Bangladesh | Phone: +88 01704-459510 |
          Email: wisdomacademyofficial@gmail.com <br>
          Copyright &copy Wisdom Academy <br>
          Developed by <a href="https://mahmudmridul.github.io/personal-website/"
          class="footlink" target="_blank">
          Abdullah Al Mahmud </a>
        </div>

    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="js/first.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
      $(document).ready(function()
      {
        $(".welcome-text").hide().fadeIn(4000);
      });
    </script>

  </body>

</html>
