<?php 
if ($_POST) {
  $name = $_POST['name'];
  $surname = $_POST['surname'];
  $phone = $_POST['phone'];

  include_once "db.php";
  $insert_query = mysqli_query($conn, "INSERT INTO people (name,surname,phone) VALUES ('$name','$surname','$phone')");
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

    <!-- My own CSS file-->
    <!--<link rel="stylesheet" href="css/style.css">-->

    <!-- FontAwesome Kit -->
    <script src="https://kit.fontawesome.com/cf3e3a7ec6.js" crossorigin="anonymous"></script>

    <title>CRUD of Contacts</title>
  </head>
  <body>
    <div class="container-fluid">
      <div class="row">
        <!-- style="height: 150px; background-color: #6495ED; border-radius: 0px 0px 6px 6px;" -->
        <div class="col-sm-12 p-5 rounded-bottom bg-secondary text-light">
          <img src="img/iPhone-icon.png" alt="" width="60" style="float: left;"><h1><?php echo strtoupper("PhoneBook Management")?></h1>
        </div>
      </div>
    </div>
    <div class="container-md">
      <br><br>
      <div class="row align-items-start" style="background-color: #f2f4f4; padding: 10px; border-radius: 6px;">
        <div class="col-sm-4">
          <!-- add new contact's form -->
          <form action="index.php" method="POST">
            <div class="mb-3">
              <label for="inputName" class="form-label">Name</label>
              <input type="text" class="form-control border border-2" name="name"  aria-describedby="">        
            </div>
            <div class="mb-3">
              <label for="inputSurname" class="form-label">Surname</label>
              <input type="text" class="form-control border border-2" name="surname">
            </div>
            <div class="mb-3">
              <label for="inputAge" class="form-label">Phone</label>
              <input type="text" class="form-control border border-2" name="phone">
            </div>
            <button type="submit" class="btn btn-success">Add to contacts</button>
          </form>
        </div>
        <div class="col-sm-8">
          <table class="table table-striped">
            <thead>
            <tr>
              <th scope="col">Id</th>
              <th scope="col">Name</th>
              <th scope="col">Surname</th>
              <th scope="col">Phone</th>
              <th scope="col" class="text-center">Notes</th>
              <th scope="col" class="text-center">Edit</th>
              <th scope="col" class="text-center">Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php include "db.php"; ?>
            <?php $query = mysqli_query($conn, "SELECT * FROM people"); ?>
            <?php
            while ($data = mysqli_fetch_row($query)) { ?>
              <tr>              
                <th scope="row"><?php echo $data[0] ?></th>
                <td><?php echo $data[1] ?></td>
                <td><?php echo $data[2] ?></td>
                <td><?php echo $data[3] ?></td>
                <td class="text-center"><a href="notes.php?id=<?php echo $data[0]?>"><i class="far fa-clipboard"></i></a></td>
                <td class="text-center"><a href="edit.php?id=<?php echo $data[0]?>"><i class="far fa-edit"></i></a></td>
                <td class="text-center"><a href="delete.php?id=<?php echo $data[0]?>&which=contact" onclick="return confirm('Do you want to delete this contact? Y/N')"><i class="far fa-trash-alt"></i></a></td>
              </tr>              
            <?php } ?>
          </tbody>   
          </table>
        </div>
      </div>
    </div>


    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
