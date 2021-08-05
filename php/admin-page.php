<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>

    <link rel="stylesheet" href="../css/admin-page.css">

  </head>

  <body>
    <?php session_start(); ?>

    <div class="header">

      <div class="panel">
        Admin Panel
      </div>

      <div class="curr-user">
        <?php echo "User: " . $_SESSION["username"]; ?>
      </div>

      <div class="logout">

        <form class=""  method="post">
          <input type="submit" name="logout" value="Logout"></input>
        </form>

      </div>

      <?php
        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['logout']))
        {
          session_destroy();
          header("Location: admin-login.php");
        }
      ?>

    </div>

    <div class="side-menu">
      <ul>

        <li>
          <a href="#admin-info">Admin Info</a>
        </li>

        <li>
          <a href="#exam">Exam</a>
        </li>

        <li>
          <a href="#student">Student</a>
        </li>

        <li>
          <a href="#home">Home</a>
        </li>

        <li>
          <a href="#news">News</a>
        </li>

        <li>
          <a href="#team">Team</a>
        </li>

        <li>
          <a href="#work">Work</a>
        </li>

      </ul>
    </div>

    <div class="container">

      <div class="admin-info" id="admin-info">
        <h2>Change Password</h2>
        <form class="" action="" method="post">

          <label> Username: </label>
          <input type="text" name="username" value="" required> <br><br>

          <label> Old Password: </label>
          <input type="password" name="old-password" value="" required> <br><br>

          <label> New Password: </label>
          <input type="text" name="new-password" value="" required> <br><br>

          <input type="submit" name="changepass" value="Change Password">

        </form>
      </div>

      <?php
        require("connect.php");

        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['changepass']))
        {

          $username = $_REQUEST["username"];
          $old_pass = $_REQUEST["old-password"];
          $new_pass = $_REQUEST["new-password"];

          $query = "SELECT * FROM admin WHERE username = '{$username}' AND password = '{$old_pass}'";
          $result = mysqli_query($connection, $query);

          if(mysqli_num_rows($result) == 1)
          {
            $query = "UPDATE admin SET password = '{$new_pass}' WHERE username = '{$username}'";
            $result = mysqli_query($connection, $query);

            if($result)
            {
              echo "<script> alert('Password changed successfully!'); window.location = 'admin-page.php'; </script>";
            }
            else
            {
              echo "<script> alert('Something went wrong!'); window.location = 'admin-page.php'; </script>";
            }
          }
          else
          {
            echo "<script> alert('Wrong username or password'); window.location = 'admin-page.php'; </script>";
          }
        }
        mysqli_close($connection);

      ?>

      <div class="exam" id="exam">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
        veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
        commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
        velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
        cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id
        est laborum.
      </div>

      <div class="student" id="student">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
        veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
        commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
        velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
        cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id
        est laborum.
      </div>

      <div class="home" id="home">

      </div>

      <div class="news" id="news">

        <h2>Delete News Contents</h2>

        <form class="" action="" method="post">

          <label> Select News ID: </label>
          <input type="number" name="news-id" value="" required><br>
          <input type="submit" name="delete-news" value="Delete">

        </form>

        <h2>News Contents</h2>


      <?php
        mysqli_report(MYSQLI_REPORT_STRICT);
        require("connect.php");

        $query = "SELECT name, id FROM news";
        $result = mysqli_query($connection, $query);

        if(mysqli_num_rows($result) >= 1)
        {
          echo "<table>";
          echo "<thead>";
          echo "<tr> <th> Name </th> <th> News ID </th>  </tr>";
          echo "</thead>";
          echo "<tbody>";
          while($row = mysqli_fetch_assoc($result))
          {
              echo "<tr> <td>" . $row["name"] . "</td> <td> " . $row["id"] . "</td> </tr>";
          }
          echo "</tbody>";
          echo "</table>";
        }
        else
        {
          echo "<h2> No news found </h2>";
        }
        mysqli_close($connection);
      ?>

      <?php
        require("connect.php");

        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete-news']))
        {
          $news_id = $_REQUEST["news-id"];
          $news_id = intval($news_id);
          $query = "DELETE FROM news WHERE id = {$news_id}";
          $result = mysqli_query($connection, $query);

          if($result)
          {
            echo "<script> alert('News Deleted successfully!'); window.location = 'admin-page.php'; </script>";
          }
          else
          {
            echo "<script> alert('Something went wrong while deleting news!'); window.location = 'admin-page.php'; </script>";
          }
        }
        mysqli_close($connection);
      ?>

      </div>

      <div class="team" id="team">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
        veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
        commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
        velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
        cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id
        est laborum.
      </div>

      <div class="work" id="work">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
        veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
        commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
        velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
        cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id
        est laborum.
      </div>

    </div>
  </body>

</html>
