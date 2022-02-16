<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- My own CSS file-->
    <!--<link rel="stylesheet" href="css/style.css">-->

    <!-- FontAwesome Kit -->
    <script src="https://kit.fontawesome.com/cf3e3a7ec6.js" crossorigin="anonymous"></script>

    <title>CRUD of Contacts</title>
  </head>
  <body>
    <div class="container-fluid">
      <div class="row text-light p-3 align-items-center" style="border-bottom: 9px solid #6495ED; background-color: #607bab;">
        <div class="col-sm-1" style="width: 80px;">
          <img src="img/iPhone-icon.png" alt="" width="84">
        </div>
        <div class="col">
          <h2 style="display: inline;"><?php echo strtoupper("PhoneBook Management") ?></h2>
        </div>
        <div class="col">
          <form action="logout.php" method="POST">
            <input type="submit" name="logout" value="Log out">
          </form>
        </div>
        <?php include "includes/search-bar.php"; ?>
      </div>
    </div>