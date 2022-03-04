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

// empty the note session value so that notes's load don't show the alert bar 
$_SESSION['msg_to_note']=''; 

if ($_POST) {
  $name = $_POST['name'];
  $surname = $_POST['surname'];
  $phone = $_POST['phone'];

  include_once "db.php";
  $insert_query = mysqli_query($conn, "INSERT INTO people (name,surname,phone) VALUES ('$name','$surname','$phone')");

  $_SESSION['msg_to_contact']='created';
}

if (!isset($_GET['search'])) {
  $value = '';
} else {
  $value = $_GET['search'];
}

include_once "db.php";
$search_query = mysqli_query($conn,"SELECT * FROM people WHERE surname LIKE '%$value%' OR name LIKE '%$value%'");
?>

<?php include "includes/header.php"; ?>

<div class="container-fluid">
  <div class="row align-items-center">  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"> </script>
    <script>
      setTimeout(function() { $('#success').fadeIn(1800,"swing"); }, 50);
      setTimeout(function() { $('#success').fadeOut(2000); }, 2850);
    </script>
    <?php
    if (isset($_SESSION['msg_to_contact'])) {
      if ($_SESSION['msg_to_contact']=='updated') {
        $text='Changes were saved successfully';
      } else if ($_SESSION['msg_to_contact']=='contact-deleted') {
        $text='Contact deleted successfully';
      } else if ($_SESSION['msg_to_contact']=='created') {
        $text='A new contact was created';
      }       
    } 
    ?>
    <?php
    $show_alert = isset($_SESSION['msg_to_contact']) && strlen($_SESSION['msg_to_contact'] > 0);
    if ($show_alert) { ?>
      <div class="col text-center alert alert-success" role="alert" id="success" style="display: none;"><?php echo $text; ?></div>
    <?php } ?>

    <?php $_SESSION['msg_to_contact']=''; ?>
      <br><br>
  </div>
</div>
<div class="container-md">
  <div class="row align-items-start">
    <div class="col-sm-3 p-4" style="background-color: #fff; padding: 10px; margin-right: 20px; border-radius: 6px;">

      <!-- add new contact's form -->
      <form action="home.php" method="POST">
        <div class="mb-3">
          <input type="text" class="form-control border border-2" name="name" aria-describedby="" placeholder="Name">        
        </div>
        <div class="mb-3">
          <input type="text" class="form-control border border-2" name="surname" placeholder="Surname">
        </div>
        <div class="mb-3">
          <input type="text" class="form-control border border-2" name="phone" placeholder="Phone">
        </div>
        <button type="submit" class="btn btn-danger">Add to contacts</button>
      </form>

    </div>

    <div class="col-sm-8 p-3" style="background-color: #fff; border-radius: 6px;">
      <table class="table table-hover">
        <thead class="table-light">
        <tr>
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
            <th scope="row" class="text-center" hidden><?php echo $data[0] ?></th>
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
  <div class="row p-4 mb-5">
    <div class="col-sm-4"></div>
    <div class="col-sm-4 align-items-center">      
    </div>
  </div>
</div>
<?php include "includes/footer.php"; ?>