<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Profile</title>

    <link rel="stylesheet" href="../css/student-page.css">
  </head>
  <body>

    <!-- SESSION START  -->
    <?php
      session_start();
      if(!array_key_exists('username',$_SESSION) && empty($_SESSION['username']))
      {
        echo "<script> alert('You have to be logged in to visit this page'); window.location = 'student-login.php'; </script>";
        die();
      }
    ?>

    <!-- HEADER OF THE PAGE  -->
    <div class="header">

      <div class="panel">
        Student Profile
      </div>

      <!-- GETTING THE CURRENT USER'S USERNAME  -->
      <div class="curr-user">
        <?php echo "User: " . $_SESSION["username"];  $_SESSION["visited"] = "yes"; ?>
      </div>

      <!-- LOGOUT BUTTON  -->
      <div class="logout">

        <form class=""  method="post">
          <input type="submit" name="logout" value="Logout"></input>
        </form>

      </div>

      <!-- LOGOUT PHP CODE  -->
      <?php
        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['logout']))
        {
          session_destroy();
          header("Location: student-login.php");
        }
      ?>

    </div>

    <!-- THE SIDE MENU  -->
    <div class="side-menu">
      <ul>

        <li>
          <a href="#admin-info" >Student Info</a>
        </li>

        <li>
          <a href="#student">Settings</a>
        </li>

      </ul>
    </div>


    <div class="container">

      <div class="student-info" id="student-info">

        <h1>Student Information</h1>
        <hr><hr>

        <?php
        require("connect.php");

        $username = $_SESSION["username"];

        $query = "SELECT * FROM student WHERE username = '{$username}'";
        $result = mysqli_query($connection, $query);

        if(mysqli_num_rows($result) == 1)
        {
          $row = mysqli_fetch_assoc($result);

          echo "<h3>  Name: " . $row["name"] . " </h3>";
          echo "<h3>  Unique ID: " . $row["id"] . " </h3>";
          echo "<h3>  E-mail: " . $row["email"] . " </h3>";
          echo "<h3>  Facebook Profile: " . "<a href= '" . $row["fb"] . "' class='fb_link' target='_blank'> ". $row["fb"] . "</a> " . " </h3>";
          echo "<h3>  Username: " . $row["username"] . " </h3>";
          echo "<h3>  Password: " . $row["password"] . " </h3>";

        }
        else
        {
          echo "<h1> Something went wrong! </h1>";
          die();
        }

        ?>

      </div>

      <div class="settings" id="settings">

        <h1>Settings</h1>
        <hr><hr>

        <h2>Update E-mail</h2>
        <form class="" action="" method="post">

          <label> Unique ID: </label>
          <input type="number" name="id" value="" required> <br><br>

          <label> New E-mail: </label>
          <input type="email" name="new_email" value="" required> <br><br>

          <input type="submit" name="change_email" value="Update">

        </form>

        <?php
          require("connect.php");

          if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['change_email']))
          {

            $id = $_REQUEST["id"];
            $new_email = $_REQUEST["new_email"];

            if(filter_var($new_email, FILTER_VALIDATE_EMAIL))
            {
              $query = "SELECT * FROM student WHERE id = '{$id}'";
              $result = mysqli_query($connection, $query);

              if(mysqli_num_rows($result) == 1)
              {
                $query = "UPDATE student SET email = '{$new_email}' WHERE id = '{$id}'";
                $result = mysqli_query($connection, $query);

                if($result)
                {
                  echo "<script> alert('E-mail changed successfully!'); window.location = 'student-page.php'; </script>";
                }
                else
                {
                  echo "<script> alert('Something went wrong!'); window.location = 'student-page.php'; </script>";
                }
              }
              else
              {
                echo "<script> alert('ID provided doesn't exist'); window.location = 'student-page.php'; </script>";
              }
            }
            else
            {
              echo "<script> alert('Provide a valid email address'); window.location = 'student-page.php'; </script>";
            }

          }
          mysqli_close($connection);

        ?>


        <br><br><br>


        <h2>Update Facebook Link</h2>
        <form class="" action="" method="post">

          <label> Unique ID: </label>
          <input type="number" name="id" value="" required> <br><br>

          <label> New Link: </label>
          <input type="text" name="new_link" value="" required> <br><br>

          <input type="submit" name="change_link" value="Update">

        </form>

        <?php
          require("connect.php");

          if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['change_link']))
          {

            $id = $_REQUEST["id"];
            $new_link = $_REQUEST["new_link"];

            if(preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$new_link))
            {
              $query = "SELECT * FROM student WHERE id = '{$id}'";
              $result = mysqli_query($connection, $query);

              if(mysqli_num_rows($result) == 1)
              {
                $query = "UPDATE student SET fb = '{$new_link}' WHERE id = '{$id}'";
                $result = mysqli_query($connection, $query);

                if($result)
                {
                  echo "<script> alert('Facebook link changed successfully!'); window.location = 'student-page.php'; </script>";
                }
                else
                {
                  echo "<script> alert('Something went wrong!'); window.location = 'student-page.php'; </script>";
                }
              }
              else
              {
                echo "<script> alert('ID provided doesn't exist'); window.location = 'student-page.php'; </script>";
              }
            }
            else
            {
              echo "<script> alert('Provide a valid link'); window.location = 'student-page.php'; </script>";
            }

          }
          mysqli_close($connection);
        ?>




        <br><br><br>

        <h2>Change Password</h2>
        <form class="" action="" method="post">

          <label> Unique ID: </label>
          <input type="number" name="id" value="" required> <br><br>

          <label> New Password: </label>
          <input type="text" name="new_password" value="" required> <br><br>

          <input type="submit" name="change_password" value="Update">

        </form>

        <?php
          require("connect.php");

          if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['change_password']))
          {

            $id = $_REQUEST["id"];
            $new_password = $_REQUEST["new_password"];


            $query = "SELECT * FROM student WHERE id = '{$id}'";
            $result = mysqli_query($connection, $query);

            if(mysqli_num_rows($result) == 1)
            {
              $query = "UPDATE student SET password = '{$new_password}' WHERE id = '{$id}'";
              $result = mysqli_query($connection, $query);

              if($result)
              {
                echo "<script> alert('Username changed successfully!'); window.location = 'student-page.php'; </script>";
              }
              else
              {
                echo "<script> alert('Something went wrong!'); window.location = 'student-page.php'; </script>";
              }
            }
            else
            {
              echo "<script> alert('ID provided doesn't exist'); window.location = 'student-page.php'; </script>";
            }


          }
          mysqli_close($connection);
        ?>



      </div>

    </div>

  </body>
</html>
