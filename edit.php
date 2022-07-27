<?php
session_start();

if(isset($_SESSION['user-name'])) {
  $varsession = $_SESSION['user-name'];
} else {
  $varsession = "";
}

if ($varsession == null || $varsession == '') {
  echo '<h3>You are not authorized to view this page</h3>';
  echo '<h5>You do not have permission to view this directory or page using the credentials that you supplied.</h5>';
  die();
}

if ($_GET) {
  $id = $_GET['id'];
  include_once "db.php";
  $select_query = mysqli_query($conn, "SELECT * FROM people WHERE id = '$id'");
  $row = mysqli_fetch_row($select_query);
}

if ($_POST) {
  $id = $_POST['id'];
  $name = addslashes($_POST['name']);
  $surname = addslashes($_POST['surname']);
  $phone = $_POST['phone'];

  include_once "db.php";
  $update_query = mysqli_query($conn, "UPDATE people SET name = '$name', surname = '$surname', phone = '$phone' WHERE id = '$id'");

  $_SESSION['msg_to_contact']='updated';

  header("Location: home.php");
}
?>

<?php include "includes/header.php"; ?>
<div class="container">
  <br><br>
  <div class="row align-items-center">
    <div class="col-sm-4">
    </div>
    <div class="col-sm-4 shadow p-3 mb-5 bg-body rounded" style="background-color: #fff; border-radius: 6px;">
      <!-- edit a contact's form -->
      <form action="edit.php" method="POST" style="padding: 10px;">
        <div class="mb-3">
          <input type="text" class="form-control" name="id" value="<?php echo $row[0]; ?>" hidden>        
        </div>
        <div class="mb-3">
          <label for="inputName" class="form-label">Name</label>
          <input type="text" class="form-control border border-2" name="name" value="<?php echo $row[1]; ?>">        
        </div>
        <div class="mb-3">
          <label for="inputSurname" class="form-label">Surname</label>
          <input type="text" class="form-control border border-2" name="surname" value="<?php echo $row[2]; ?>">
        </div>
        <div class="mb-3">
          <label for="inputAge" class="form-label">Phone</label>
          <input type="text" class="form-control border border-2" name="phone" value="<?php echo $row[3]; ?>">
        </div>
        <button type="submit" class="btn btn-danger">Save changes</button>
      </form>
    </div>
  </div>
</div>
<?php include "includes/footer.php"; ?>
