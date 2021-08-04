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
        Logout
      </div>

    </div>
    <div class="container">

    </div>
  </body>

</html>
