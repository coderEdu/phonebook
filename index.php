<?php
session_start();

if ($_POST) {
  $user = $_POST['user'];
  $pass = $_POST['pass'];

  include_once "db.php";
  $query = mysqli_query($conn, "SELECT * FROM login WHERE user = '$user' AND pass = '$pass'");
  
  if (mysqli_num_rows($query)===1) {
    $row = mysqli_fetch_row($query);
    $_SESSION['user-name']=$row[1];
    $_SESSION['user-pass']=$row[2];
    header("Location: home.php");
  }
}
?>

<?php include "includes/header.php"; ?>
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
<?php include "includes/footer.php"; ?>
