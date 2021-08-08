<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>

    <link rel="stylesheet" href="../css/admin-page.css">

  </head>

  <body>

    <!-- SESSION START  -->
    <?php
      session_start();
      if(!array_key_exists('username',$_SESSION) && empty($_SESSION['username']))
      {
        echo "<script> alert('You have to be logged in to visit this page'); window.location = 'admin-login.php'; </script>";
        die();
      }
    ?>

    <!-- HEADER OF THE PAGE  -->
    <div class="header">

      <div class="panel">
        Admin Panel
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
          header("Location: admin-login.php");
        }
      ?>

    </div>

    <!-- THE SIDE MENU  -->
    <div class="side-menu">
      <ul>

        <li>
          <a href="#admin-info">Admin Info</a>
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

    <!-- THE CONTAINER THAT HOLDS EACH SECTION OF THE PAGE  -->
    <div class="container">

      <!-- PASSWORD CHANGE SECTION FOR ADMIN  -->
      <div class="admin-info" id="admin-info">
        <h1>Admin Information</h1>
        <hr><hr>

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

      <!-- PASSWORD CHANGE PHP CODE  -->
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

      <!-- STUDENT SECTION  -->
      <div class="student" id="student">
        <h1>Student Information</h1>
        <hr><hr>

        <!-- showing all students information -->
        <?php
        require("connect.php");

        $query = "SELECT * FROM student";
        $result = mysqli_query($connection, $query);

        if(mysqli_num_rows($result) >= 1)
        {
          echo "<table>";
          echo "<thead>";
          echo "<tr> <th> Name </th> <th> ID </th> <th> E-mail </th> <th> Facebook Account </th> <th> Username </th></tr>";
          echo "</thead>";
          echo "<tbody>";
          while($row = mysqli_fetch_assoc($result))
          {
              echo "<tr> ";
              echo "<td>" . $row["name"] . "</td>";
              echo "<td> " . $row["id"] . "</td>";
              echo "<td> " . $row["email"] . "</td>";
              echo "<td> " . $row["fb"] . "</td>";
              echo "<td> " . $row["username"] . "</td>";
              echo "</tr>";
          }
          echo "</tbody>";
          echo "</table>";
        }
        else
        {
          echo "<h2> No student found </h2>";
        }
        mysqli_close($connection);
        ?>

        <!-- change name of the student  -->
        <h2>Name Correction</h2>
        <form class="" action="" method="post">

          <label> Unique ID: </label>
          <input type="number" name="id" value="" required> <br><br>

          <label> Name: </label>
          <input type="text" name="name" value="" required> <br><br>

          <input type="submit" name="corr_name" value="Update">

        </form>

        <?php
          require("connect.php");

          if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['corr_name']))
          {

            $id = $_REQUEST["id"];
            $name = $_REQUEST["name"];

            if(preg_match("/^[a-zA-Z-' ]*$/", $name))
            {
              $query = "SELECT * FROM student WHERE id = '{$id}'";
              $result = mysqli_query($connection, $query);

              if(mysqli_num_rows($result) == 1)
              {
                $query = "UPDATE student SET name = '{$name}' WHERE id = '{$id}'";
                $result = mysqli_query($connection, $query);

                if($result)
                {
                  echo "<script> alert('Name changed successfully!'); window.location = 'admin-page.php'; </script>";
                }
                else
                {
                  echo "<script> alert('Something went wrong!'); window.location = 'admin-page.php'; </script>";
                }
              }
              else
              {
                echo "<script> alert('ID provided doesn't exist'); window.location = 'admin-page.php'; </script>";
              }
            }
            else
            {
              echo "<script> alert('Provide a valid name'); window.location = 'admin-page.php'; </script>";
            }

          }
          mysqli_close($connection);
        ?>

        <br><br><br>

        <!-- change username  -->
        <h2>Change Username</h2>
        <form class="" action="" method="post">

          <label> Unique ID: </label>
          <input type="number" name="id" value="" required> <br><br>

          <label> Username: </label>
          <input type="text" name="username" value="" required> <br><br>

          <input type="submit" name="change_username" value="Update">

        </form>

        <?php
          require("connect.php");

          if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['change_username']))
          {

            $id = $_REQUEST["id"];
            $username = $_REQUEST["username"];


            $query = "SELECT * FROM student WHERE id = '{$id}'";
            $result = mysqli_query($connection, $query);

            if(mysqli_num_rows($result) == 1)
            {
              $query = "UPDATE student SET username = '{$username}' WHERE id = '{$id}'";
              $result = mysqli_query($connection, $query);

              if($result)
              {
                echo "<script> alert('Username changed successfully!'); window.location = 'admin-page.php'; </script>";
              }
              else
              {
                echo "<script> alert('Something went wrong!'); window.location = 'admin-page.php'; </script>";
              }
            }
            else
            {
              echo "<script> alert('ID provided doesn't exist'); window.location = 'admin-page.php'; </script>";
            }

          }
          mysqli_close($connection);
        ?>

      </div>

      <!-- HOME SECTION  -->
      <div class="home" id="home">
        <h1>Home Page</h1>
        <hr><hr>

          <!-- REMOVE CURRENT EVENT CONTENTS FORM  -->
          <h2>Remove Cuurent Event</h2>

          <form class="" action="" method="post">

            <label> Select News ID: </label>
            <input type="number" name="current_event_id" value="" required><br>
            <input type="submit" name="delete_current_event" value="Remove">

          </form>

          <h2>Current Events</h2>

          <!-- SHOWING ALL CURRRENT EVNETS CURRENTLY IN DISPLAY PHP CODE  -->
          <?php
          require("connect.php");

          $query = "SELECT name, id FROM current_event";
          $result = mysqli_query($connection, $query);

          if(mysqli_num_rows($result) >= 1)
          {
            echo "<table>";
            echo "<thead>";
            echo "<tr> <th> Event </th> <th> Event ID </th>  </tr>";
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
            echo "<h2> No event found </h2>";
          }
          mysqli_close($connection);
          ?>

        <!-- REMOVE CURRENT EVENT PHP CODE  -->
          <?php
          require("connect.php");

          if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_current_event']))
          {
            $current_event_id = $_REQUEST["current_event_id"];

            $query = "SELECT * FROM current_event WHERE id = {$current_event_id}";
            $result = mysqli_query($connection, $query);

            if(mysqli_num_rows($result) == 1)
            {
              $row = mysqli_fetch_assoc($result);
              $name = $row["name"];
              $extension = $row["extension"];
              $directory = "../image/current_event/";
              $filename = $name . "." . $extension;

              $query = "DELETE FROM current_event WHERE id = {$current_event_id}";
              $result = mysqli_query($connection, $query);
              chdir($directory);
              unlink($filename);
              echo "<script> alert('Event removed successfully!'); window.location = 'admin-page.php'; </script>";
            }
            else
            {
              echo "<script> alert('The ID provided does not exist!'); window.location = 'admin-page.php'; </script>";
            }
          }
          mysqli_close($connection);
          ?>

        <!-- UPLOAD CURRENT EVENT CONTENTS FORM  -->
          <h2>Upload Current Event</h2>

          <form class="" action="" method="post" enctype="multipart/form-data">

          <label> Image File: </label>
          <input type="file" name="current_event_upload[]" value="" multiple required><br>
          <input type="submit" name="upload_current_event" value="Upload">

          </form>

        <!-- UPLOAD NEWS CONTENTS PHP CODE  -->
          <?php
          require("connect.php");

          if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['upload_current_event']))
          {
            if(isset($_FILES['current_event_upload']))
            {
              $file_array = reArrayFiles($_FILES['current_event_upload']);

              for($i = 0; $i < count($file_array); ++$i)
              {
                if($file_array[$i]['error'])
                {
                  echo "<script> alert('Something went wrong while uploading!'); window.location = 'admin-page.php'; </script>";
                }
                else
                {
                  $extensions = array('jpg', 'jpeg', 'png');
                  $file_extension = explode('.', $file_array[$i]['name']);
                  $name = $file_extension[0];
                  $file_extension = end($file_extension);

                  if(!in_array($file_extension, $extensions))
                  {
                    echo "<script> alert('Invalid file extension!'); window.location = 'admin-page.php'; </script>";
                  }
                  else
                  {
                    $directory = "../image/current_event/" . $file_array[$i]['name'];
                    move_uploaded_file($file_array[$i]['tmp_name'], $directory);

                    $query = "INSERT INTO current_event(name, directory, extension) VALUES ('$name','$directory', '$file_extension')";
                    $result = mysqli_query($connection, $query);
                    echo "<script> alert('File uploaded successfully!'); window.location = 'admin-page.php'; </script>";
                  }
                }
              }
            }
          }
          mysqli_close($connection);
          ?>

          <!-- REMOVE UPCOMING EVENT CONTENTS FORM  -->
          <h2>Remove Upcoming Event</h2>

          <form class="" action="" method="post">

            <label> Select News ID: </label>
            <input type="number" name="upcoming_event_id" value="" required><br>
            <input type="submit" name="delete_upcoming_event" value="Remove">

          </form>

          <h2>Upcoming Events</h2>

          <!-- SHOWING ALL UPCOMING EVNETS CURRENTLY IN DISPLAY PHP CODE  -->
          <?php
          require("connect.php");

          $query = "SELECT name, id FROM upcoming_event";
          $result = mysqli_query($connection, $query);

          if(mysqli_num_rows($result) >= 1)
          {
            echo "<table>";
            echo "<thead>";
            echo "<tr> <th> Event </th> <th> Event ID </th>  </tr>";
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
            echo "<h2> No event found </h2>";
          }
          mysqli_close($connection);
          ?>

        <!-- REMOVE UPCOMING EVENT PHP CODE  -->
          <?php
          require("connect.php");

          if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_upcoming_event']))
          {
            $upcoming_event_id = $_REQUEST["current_event_id"];

            $query = "SELECT * FROM upcoming_event WHERE id = {$upcoming_event_id}";
            $result = mysqli_query($connection, $query);

            if(mysqli_num_rows($result) == 1)
            {
              $row = mysqli_fetch_assoc($result);
              $name = $row["name"];
              $extension = $row["extension"];
              $directory = "../image/upcoming_event/";
              $filename = $name . "." . $extension;

              $query = "DELETE FROM current_event WHERE id = {$upcoming_event_id}";
              $result = mysqli_query($connection, $query);
              chdir($directory);
              unlink($filename);
              echo "<script> alert('Event removed successfully!'); window.location = 'admin-page.php'; </script>";
            }
            else
            {
              echo "<script> alert('The ID provided does not exist!'); window.location = 'admin-page.php'; </script>";
            }
          }
          mysqli_close($connection);
          ?>

        <!-- UPLOAD UPCOMING EVENT CONTENTS FORM  -->
          <h2>Upload Upcoming Event</h2>

          <form class="" action="" method="post" enctype="multipart/form-data">

          <label> Image File: </label>
          <input type="file" name="upcoming_event_upload[]" value="" multiple required><br>
          <input type="submit" name="upload_upcoming_event" value="Upload">

          </form>

        <!-- UPLOAD UPCOMING EVENT CONTENTS PHP CODE  -->
          <?php
          require("connect.php");

          if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['upload_upcoming_event']))
          {
            if(isset($_FILES['upcoming_event_upload']))
            {
              $file_array = reArrayFiles($_FILES['upcoming_event_upload']);

              for($i = 0; $i < count($file_array); ++$i)
              {
                if($file_array[$i]['error'])
                {
                  echo "<script> alert('Something went wrong while uploading!'); window.location = 'admin-page.php'; </script>";
                }
                else
                {
                  $extensions = array('jpg', 'jpeg', 'png');
                  $file_extension = explode('.', $file_array[$i]['name']);
                  $name = $file_extension[0];
                  $file_extension = end($file_extension);

                  if(!in_array($file_extension, $extensions))
                  {
                    echo "<script> alert('Invalid file extension!'); window.location = 'admin-page.php'; </script>";
                  }
                  else
                  {
                    $directory = "../image/upcoming_event/" . $file_array[$i]['name'];
                    move_uploaded_file($file_array[$i]['tmp_name'], $directory);

                    $query = "INSERT INTO upcoming_event(name, directory, extension) VALUES ('$name','$directory', '$file_extension')";
                    $result = mysqli_query($connection, $query);
                    echo "<script> alert('File uploaded successfully!'); window.location = 'admin-page.php'; </script>";
                  }
                }
              }
            }
          }
          mysqli_close($connection);
          ?>

      </div>

      <!-- NEWS SECTION  -->
      <div class="news" id="news">

        <h1>News Page</h1>
        <hr><hr>

        <!-- REMOVE NEWS CONTENTS FORM  -->
        <h2>Remove News Contents</h2>

        <form class="" action="" method="post">

          <label> Select News ID: </label>
          <input type="number" name="news-id" value="" required><br>
          <input type="submit" name="delete-news" value="Remove">

        </form>

        <h2>News Contents</h2>

        <!-- SHOWING ALL NEWS CONTENTS CURRENTLY IN DISPLAY PHP CODE  -->
        <?php
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

      <!-- REMOVE NEWS CONTENTS PHP CODE  -->
        <?php
        require("connect.php");

        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete-news']))
        {
          $news_id = $_REQUEST["news-id"];

          $query = "SELECT * FROM news WHERE id = {$news_id}";
          $result = mysqli_query($connection, $query);
          $row = mysqli_fetch_assoc($result);
          $name = $row["name"];
          $extension = $row["extension"];
          $directory = "../image/news/";
          $filename = $name . "." . $extension;

          if(mysqli_num_rows($result) == 1)
          {
            $query = "DELETE FROM news WHERE id = {$news_id}";
            $result = mysqli_query($connection, $query);
            chdir($directory);
            unlink($filename);
            echo "<script> alert('News Deleted successfully!'); window.location = 'admin-page.php'; </script>";
          }
          else
          {
            echo "<script> alert('The ID provided does not exist!'); window.location = 'admin-page.php'; </script>";
          }
        }
        mysqli_close($connection);
        ?>

      <!-- UPLOAD NEWS CONTENTS FORM  -->
        <h2>Upload News Contents</h2>

        <form class="" action="" method="post" enctype="multipart/form-data">

        <label> Image File: </label>
        <input type="file" name="news_upload[]" value="" multiple required><br>
        <input type="submit" name="news_upload_button" value="Upload">

        </form>

      <!-- UPLOAD NEWS CONTENTS PHP CODE  -->
        <?php
        require("connect.php");

        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['news_upload_button']))
        {
          if(isset($_FILES['news_upload']))
          {
            $file_array = reArrayFiles($_FILES['news_upload']);

            for($i = 0; $i < count($file_array); ++$i)
            {
              if($file_array[$i]['error'])
              {
                echo "<script> alert('Something went wrong while uploading!'); window.location = 'admin-page.php'; </script>";
              }
              else
              {
                $extensions = array('jpg', 'jpeg', 'png');
                $file_extension = explode('.', $file_array[$i]['name']);
                $name = $file_extension[0];
                $file_extension = end($file_extension);

                if(!in_array($file_extension, $extensions))
                {
                  echo "<script> alert('Invalid file extension!'); window.location = 'admin-page.php'; </script>";
                }
                else
                {
                  $directory = "../image/news/" . $file_array[$i]['name'];
                  move_uploaded_file($file_array[$i]['tmp_name'], $directory);

                  $query = "INSERT INTO news(name, directory, extension) VALUES ('$name','$directory', '$file_extension')";
                  $result = mysqli_query($connection, $query);
                  echo "<script> alert('File uploaded successfully!'); window.location = 'admin-page.php'; </script>";
                }
              }
            }
          }
        }

        function reArrayFiles($file)
        {
          $file_ary = array();
          $file_count = count($file['name']);
          $file_key = array_keys($file);

          for($i=0;$i<$file_count;$i++)
          {
            foreach($file_key as $val)
            {
                $file_ary[$i][$val] = $file[$val][$i];
            }
          }
          return $file_ary;
        }
        mysqli_close($connection);
        ?>

      </div>

      <!-- TEAM SECTION -->
      <div class="team" id="team">

        <h1>Team Information</h1>
        <hr><hr>

        <h2>Remove a Member</h2>

        <!-- REMOVE TEAM MEMBER FORM  -->
        <form class="" action="" method="post">

          <label> Select Member ID: </label>
          <input type="number" name="member_id" value="" required><br>
          <input type="submit" name="delete_member" value="Remove">

        </form>

        <h2>Team Members</h2>

        <!-- SHOWING ALL TEAM MEMBER CURRENTLY IN DISPLAY PHP CODE  -->
        <?php
        require("connect.php");

        $query = "SELECT * FROM team";
        $result = mysqli_query($connection, $query);

        if(mysqli_num_rows($result) >= 1)
        {
          echo "<table>";
          echo "<thead>";
          echo "<tr> <th> Name </th> <th> Member ID </th> <th> Category </th>  </tr>";
          echo "</thead>";
          echo "<tbody>";
          while($row = mysqli_fetch_assoc($result))
          {
              echo "<tr> <td>" . $row["name"] . "</td> <td> " . $row["id"] . "</td> <td> " . $row["category"] . " </td> </tr>";
          }
          echo "</tbody>";
          echo "</table>";
        }
        else
        {
          echo "<h2> No member found </h2>";
        }
        mysqli_close($connection);
      ?>

      <!-- REMOVE A TEAM MEMBER PHP CODE  -->
      <?php
        require("connect.php");

        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_member']))
        {
          $member_id = $_REQUEST["member_id"];

          $query = "SELECT * FROM team WHERE id = {$member_id}";
          $result = mysqli_query($connection, $query);
          $row = mysqli_fetch_assoc($result);
          $name = $row["name"];
          $extension = $row["extension"];
          $directory = "../image/team/";
          $filename = $name . "." . $extension;

          if(mysqli_num_rows($result) == 1)
          {
            $query = "DELETE FROM team WHERE id = {$member_id}";
            $result = mysqli_query($connection, $query);
            chdir($directory);
            unlink($filename);
            echo "<script> alert('Member removed successfully!'); window.location = 'admin-page.php'; </script>";
          }
          else
          {
            echo "<script> alert('The ID provided does not exist!'); window.location = 'admin-page.php'; </script>";
          }
        }
        mysqli_close($connection);
      ?>


      <!-- UPLOAD TEAM MEMBER FORM  -->
      <h2>Upload Team Member Image</h2>

      <form class="" action="" method="post" enctype="multipart/form-data">

        <label> Image File: </label>
        <input type="file" name="member_upload[]" value="" multiple required><br>
        <label> Category: </label>
        <select class="" name="member_category">
          <option value="none">None</option>
          <option value="member_core">Core</option>
          <option value="intern_business_development">Business Development (Intern)</option>
          <option value="intern_content_writing">Content Writing (Intern)</option>
          <option value="intern_graphics">Graphics (Intern)</option>
          <option value="intern_marketing">Marketing (Intern)</option>
          <option value="intern_public_relation">Public Relation (Intern)</option>
          <option value="intern_research">Research (Intern)</option>
          <option value="intern_web_development">Web Development (Intern)</option>
        </select>
        <input type="submit" name="member_upload_button" value="Upload">

      </form>

      <!-- UPLOAD NEWS CONTENTS PHP CODE  -->
      <?php
        require("connect.php");

        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['member_upload_button']))
        {
          if(isset($_FILES['member_upload']))
          {
            $category = $_REQUEST["member_category"];
            $file_array = reArrayFiles($_FILES['member_upload']);

            for($i = 0; $i < count($file_array); ++$i)
            {
              if($file_array[$i]['error'])
              {
                echo "<script> alert('Something went wrong while uploading!'); window.location = 'admin-page.php'; </script>";
              }
              else
              {
                $extensions = array('jpg', 'jpeg', 'png');
                $file_extension = explode('.', $file_array[$i]['name']);
                $name = $file_extension[0];
                $file_extension = end($file_extension);

                if(!in_array($file_extension, $extensions))
                {
                  echo "<script> alert('Invalid file extension!'); window.location = 'admin-page.php'; </script>";
                }
                else
                {
                  $directory = "../image/team/" . $file_array[$i]['name'];
                  move_uploaded_file($file_array[$i]['tmp_name'], $directory);

                  $query = "INSERT INTO team(name, directory, category, extension) VALUES ('$name','$directory', '$category', '$file_extension')";
                  $result = mysqli_query($connection, $query);
                  echo "<script> alert('File uploaded successfully!'); window.location = 'admin-page.php'; </script>";
                }
              }
            }
          }
        }
        mysqli_close($connection);
      ?>
      </div>

      <div class="work" id="work">
        <h1>Work Page</h1>
        <hr><hr>
        <!-- REMOVE WORK CONTENTS FORM  -->
        <h2>Remove Work Contents</h2>

        <form class="" action="" method="post">

          <label> Select News ID: </label>
          <input type="number" name="work_id" value="" required><br>
          <input type="submit" name="delete_work" value="Remove">

        </form>

        <h2>Work Contents</h2>

        <!-- SHOWING ALL WORK CONTENTS CURRENTLY IN DISPLAY PHP CODE  -->
      <?php
        require("connect.php");

        $query = "SELECT name, id FROM work";
        $result = mysqli_query($connection, $query);

        if(mysqli_num_rows($result) >= 1)
        {
          echo "<table>";
          echo "<thead>";
          echo "<tr> <th> Name </th> <th> Work ID </th>  </tr>";
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
          echo "<h2> No work found </h2>";
        }
        mysqli_close($connection);
      ?>

      <!-- REMOVE WORK CONTENTS PHP CODE  -->
      <?php
        require("connect.php");

        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_work']))
        {
          $work_id = $_REQUEST["work_id"];

          $query = "SELECT * FROM work WHERE id = {$work_id}";
          $result = mysqli_query($connection, $query);
          $row = mysqli_fetch_assoc($result);
          $name = $row["name"];
          $extension = $row["extension"];
          $directory = "../image/work/";
          $filename = $name . "." . $extension;

          if(mysqli_num_rows($result) == 1)
          {
            $query = "DELETE FROM work WHERE id = {$work_id}";
            $result = mysqli_query($connection, $query);
            chdir($directory);
            unlink($filename);
            echo "<script> alert('Work Deleted successfully!'); window.location = 'admin-page.php'; </script>";
          }
          else
          {
            echo "<script> alert('The ID provided does not exist!'); window.location = 'admin-page.php'; </script>";
          }
        }
        mysqli_close($connection);
      ?>

      <!-- UPLOAD WORK CONTENTS FORM  -->
      <h2>Upload Work Contents</h2>

      <form class="" action="" method="post" enctype="multipart/form-data">

        <label> Image File: </label>
        <input type="file" name="work_upload[]" value="" multiple required><br>
        <input type="submit" name="work_upload_button" value="Upload">

      </form>

      <!-- UPLOAD WORK CONTENTS PHP CODE  -->
      <?php
        require("connect.php");

        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['work_upload_button']))
        {
          if(isset($_FILES['work_upload']))
          {
            $file_array = reArrayFiles($_FILES['work_upload']);

            for($i = 0; $i < count($file_array); ++$i)
            {
              if($file_array[$i]['error'])
              {
                echo "<script> alert('Something went wrong while uploading!'); window.location = 'admin-page.php'; </script>";
              }
              else
              {
                $extensions = array('jpg', 'jpeg', 'png');
                $file_extension = explode('.', $file_array[$i]['name']);
                $name = $file_extension[0];
                $file_extension = end($file_extension);

                if(!in_array($file_extension, $extensions))
                {
                  echo "<script> alert('Invalid file extension!'); window.location = 'admin-page.php'; </script>";
                }
                else
                {
                  $directory = "../image/work/" . $file_array[$i]['name'];
                  move_uploaded_file($file_array[$i]['tmp_name'], $directory);

                  $query = "INSERT INTO work(name, directory, extension) VALUES ('$name','$directory', '$file_extension')";
                  $result = mysqli_query($connection, $query);
                  echo "<script> alert('File uploaded successfully!'); window.location = 'admin-page.php'; </script>";
                }
              }
            }
          }
        }

        mysqli_close($connection);
      ?>

      </div>

    </div>
  </body>

</html>
