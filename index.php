<?php
if ($_POST) {
  $user = $_POST['user'];
  $pass = $_POST['pass'];

  include_once "db.php";
  $query = mysqli_query($conn, "SELECT * FROM login WHERE user = '$user' AND pass = '$pass'");
  
  if (mysqli_num_rows($query)===1) {
    header("Location: home.php");
  }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- FontAwesome Kit -->
    <script src="https://kit.fontawesome.com/cf3e3a7ec6.js" crossorigin="anonymous"></script>

    <title>Editing a contact</title>
  </head>
  <body>
    <div class="container-fluid">
      <div class="row text-light p-4 align-items-center" style="border-bottom: 9px solid #6495ED; background-color: #607bab;">
        <div class="col-sm-1" style="width: 80px;">
          <img src="img/iPhone-icon.png" alt="" width="84">
        </div>
        <div class="col">
          <h2 style="display: inline;"><?php echo strtoupper("PhoneBook Management - LOGIN") ?></h2>
        </div>
      </div>
    <div class="container">
      <br><br><br>
      <div class="row align-items-center">
        <div class="col-sm-4">
        </div>
        <div class="col-sm-4" style="background-color: #f2f4f4; border-radius: 6px;">
          <!-- login form -->
          <form action="index.php" method="POST" style="padding: 10px;">
            <div class="mb-3">
              <label for="inputUser" class="form-label">User</label>
              <input type="text" class="form-control border border-2" name="user">        
            </div>
            <div class="mb-3">
              <label for="inputPass" class="form-label">Password</label>
              <input type="password" class="form-control border border-2" name="pass">
            </div>
            <div class="mb-3">
              <button type="submit" class="btn btn-success">log In</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
