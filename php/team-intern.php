<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
    crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/team-intern.css">

  </head>
  <body>

    <div class="progress-bar" id="scrollBar"></div>

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

    <div class="my-container">

      <?php
        require("connect.php");

        echo "<div class = 'intern'> Interns of Wisdom Academy </div>";

        echo "<div class = 'other_header'> Business Development </div>";

        $query = "SELECT * FROM team WHERE category = 'intern_business_development'";
        $result = mysqli_query($connection, $query);

        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_assoc($result))
            {
                echo "<img src=" . "'" . $row['directory']. "'"  ." class='images'>";
            }
        }


        echo "<div class = 'other_header'> Content Writing </div>";

        $query = "SELECT * FROM team WHERE category = 'intern_content_writing'";
        $result = mysqli_query($connection, $query);

        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_assoc($result))
            {
                echo "<img src=" . "'" . $row['directory']. "'"  ." class='images'>";
            }
        }

        echo "<div class = 'other_header'> Graphics </div>";

        $query = "SELECT * FROM team WHERE category = 'intern_graphics'";
        $result = mysqli_query($connection, $query);

        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_assoc($result))
            {
                echo "<img src=" . "'" . $row['directory']. "'"  ." class='images'>";
            }
        }

        echo "<div class = 'other_header'> Marketing </div>";

        $query = "SELECT * FROM team WHERE category = 'intern_marketing'";
        $result = mysqli_query($connection, $query);

        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_assoc($result))
            {
                echo "<img src=" . "'" . $row['directory']. "'"  ." class='images'>";
            }
        }

        echo "<div class = 'other_header'> Public Relation </div>";

        $query = "SELECT * FROM team WHERE category = 'intern_public_relation'";
        $result = mysqli_query($connection, $query);

        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_assoc($result))
            {
                echo "<img src=" . "'" . $row['directory']. "'"  ." class='images'>";
            }
        }

        echo "<div class = 'other_header'> Research </div>";

        $query = "SELECT * FROM team WHERE category = 'intern_research'";
        $result = mysqli_query($connection, $query);

        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_assoc($result))
            {
                echo "<img src=" . "'" . $row['directory']. "'"  ." class='images'>";
            }
        }

        echo "<div class = 'other_header'> Web Development </div>";

        $query = "SELECT * FROM team WHERE category = 'intern_web_development'";
        $result = mysqli_query($connection, $query);

        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_assoc($result))
            {
                echo "<img src=" . "'" . $row['directory']. "'"  ." class='images'>";
            }
        }

        mysqli_close($connection);
      ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="../js/first.js"></script>

  </body>
</html>
