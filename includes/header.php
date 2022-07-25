<?php session_start(); ?>
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
    <!-- <script src="https://kit.fontawesome.com/cf3e3a7ec6.js" crossorigin="anonymous"></script> -->
    <script src="https://kit.fontawesome.com/ff8683a659.js" crossorigin="anonymous"></script>


    <title>PhoneBook Management</title>
  </head>
  <body style="background-color: #f0f4f7;">
    <div class="container-fluid">
      <div class="row text-light p-3 align-items-center" style="border-bottom: 9px solid #6495ED; background-color: #607bab;">
        <div class="col-sm-1" style="width: 80px;">
          <a href="home.php"><img src="img/iPhone-icon.png" alt="" width="84"></a>
        </div>
        <div class="col-sm-3">
          <h2 style="display: inline; font-family: Verdana;"><?php echo strtoupper("PhoneBook Management") ?></h2>
        </div>
        <div class="col-sm-3">
          <h3 class="align-middle text-end mb-0"><?php if (isset($_SESSION['user-name'])) {echo 'Hello, '.$_SESSION['user-name'];} ?></h3>
        </div>
        <div class="col-sm-1">

        <?php if (isset($_SESSION['user-name'])) { ?>          
          <form action="logout.php" method="POST">
            <input type="submit" class="btn btn-danger" name="logout" value="Log out">
          </form>
        <?php } ?>      
          
        </div>
        <div class="col-sm-1"></div>
        <?php include "includes/search-bar.php"; ?>
      </div>
    </div>