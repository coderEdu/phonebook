<?php
session_start();

if (!isset($_SESSION['user-name']) && !isset($_SESSION['user-pass'])) {
  header("Location: index.php");
  exit();
}

if ($_POST) {
  $name = $_POST['name'];
  $surname = $_POST['surname'];
  $phone = $_POST['phone'];

  include_once "db.php";
  $insert_query = mysqli_query($conn, "INSERT INTO people (name,surname,phone) VALUES ('$name','$surname','$phone')");

  $_SESSION['message']='created';


}

if (isset($_GET['search'])) {
  $value = $_GET['search'];
  include_once "db.php";
  $search_query = mysqli_query($conn,"SELECT * FROM people WHERE surname LIKE '%$value%' OR name LIKE '%$value%'");
}
?>

<?php include "includes/header.php"; ?>

<div class="container-fluid">
  <div class="row align-items-center">
    <?php// if (isset($_SESSION['saved'])) { ?>    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"> </script>
    <script>
            setTimeout(function() { $('#success').fadeOut('slow'); }, 2200);
    </script>
    <?php
    if (isset($_SESSION['message'])) {
      if ($_SESSION['message']=='updated') {
        $text='Changes was saved succesfully';
      } else if ($_SESSION['message']=='deleted') {
        $text='contact was deleted succesfully';
      } else if ($_SESSION['message']=='created') {
        $text='New contact created';
      }       
    } 
    ?>
    <?php
    $show_alert = isset($_SESSION['message']);
    if ($show_alert) { ?>
      <div class="col text-center alert alert-success" role="alert" id="success"><?php echo $text; ?></div>
    <?php } ?>

    <?php //} ?>
    <?php 
    session_unset();
    session_destroy();
    ?>
      <br><br>
  </div>
</div>
<div class="container-md">
  <div class="row align-items-start" style="background-color: #f2f4f4; border-radius: 6px;">
    <div class="col-sm-4 p-4">
      <!-- add new contact's form -->
      <form action="home.php" method="POST">
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
    <div class="col-sm-8 p-3">
      <table class="table table-light table-striped">
        <thead class="table-light">
        <tr>
          <th scope="col" class="text-center">Id</th>
          <th scope="col" class="text-center">Name</th>
          <th scope="col" class="text-center">Surname</th>
          <th scope="col" class="text-center">Phone</th>
          <th scope="col" class="text-center">Notes</th>
          <th scope="col" class="text-center">Edit</th>
          <th scope="col" class="text-center">Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php include "db.php"; ?>
        <?php $star_query = mysqli_query($conn, "SELECT * FROM people"); ?>
        <?php

        if ($value=='') {
          $sql = $star_query;
        } else {
          $sql = $search_query;
        }

        while ($data = mysqli_fetch_row($sql)) { ?>
          <tr>              
            <th scope="row"><?php echo $data[0] ?></th>
            <td class="text-center"><?php echo $data[1] ?></td>
            <td class="text-center"><?php echo $data[2] ?></td>
            <td class="text-center"><?php echo $data[3] ?></td>
            <td class="text-center"><a href="notes.php?id=<?php echo $data[0]?>"><i class="far fa-clipboard"></i></a></td>
            <td class="text-center"><a href="edit.php?id=<?php echo $data[0]?>"><i class="far fa-edit"></i></a></td>
            <td class="text-center"><a href="delete.php?id=<?php echo $data[0]?>&which=contact" onclick="return confirm('Do you want to delete this contact? Y/N')"><i class="far fa-trash-alt"></i></a></td>
          </tr>              
        <?php } ?>
      </tbody>   
      </table>
    </div>
  </div>
  <div class="row p-4">
    <div class="col-sm-4"></div>
    <div class="col-sm-4 align-items-center">
      <?php include "includes/pagination.php"; ?>
    </div>
  </div>
</div>
<?php include "includes/footer.php"; ?>



