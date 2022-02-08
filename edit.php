<?php
if ($_GET) {
  $id = $_GET['id'];
  include_once "db.php";
  $select_query = mysqli_query($conn, "SELECT * FROM people WHERE id = '$id'");
  $row = mysqli_fetch_row($select_query);
}

if ($_POST) {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $surname = $_POST['surname'];
  $phone = $_POST['phone'];

  include_once "db.php";
  $update_query = mysqli_query($conn, "UPDATE people SET name = '$name', surname = '$surname', phone = '$phone' WHERE id = '$id'");
  header("Location: index.php");
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
      <div class="row">
        <!-- style="height: 150px; background-color: #6495ED; border-radius: 0px 0px 6px 6px;" -->
        <div class="col-sm-12 p-5 rounded-bottom bg-secondary text-white">
          <img src="img/iPhone-icon.png" alt="" width="60" style="float: left;"><h1>Editing Contact: <?php echo strtoupper($row[1].' '.$row[2]); ?></h1>
        </div>
      </div>
    </div>
    <div class="container">
      <br><br>
      <div class="row align-items-center">
        <div class="col-sm-4">
        </div>
        <div class="col-sm-4" style="background-color: #f2f4f4; border-radius: 6px;">
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
            <button type="submit" class="btn btn-success">Save changes</button>
          </form>
        </div>
      </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
