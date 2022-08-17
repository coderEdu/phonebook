<?php
if (!isset($_SESSION)) {
  session_start();
}

if(isset($_SESSION['user-name'])) {
  $varsession = $_SESSION['user-name'];
} else {
  $varsession = "";
}

if (isset($_SESSION['logged_id'])) {
  $logged_id = $_SESSION['logged_id'];
}

if ($varsession == null || $varsession == '') {
  echo '<h3>You are not authorized to view this page</h3>';
  echo '<h5>You do not have permission to view this directory or page using the credentials that you supplied.</h5>';
  die();
}

// empty the note session value so that notes's load don't show the alert bar 
$_SESSION['msg_to_note']=''; 

if ($_POST) {
  $name = addslashes($_POST['name']);
  $surname = addslashes($_POST['surname']);
  $phone = $_POST['phone'];

  include_once "db.php";
  $insert_query = mysqli_query($conn, "INSERT INTO people (name,surname,phone,log_id) VALUES ('$name','$surname','$phone','$logged_id')");

  $_SESSION['msg_to_contact']='created';
}

if (!isset($_GET['search'])) {
  $value = '';
} else {
  $value = $_GET['search'];
}

?>

<?php include "includes/header.php"; ?>
<?php include_once "includes/functions.php"; ?>

<div class="container-fluid">
  <div class="row align-items-center">  

    <?php $_SESSION['msg_to_contact']=''; ?>
    <br><br>
  </div>
</div>
<div class="container-md">
  <div class="row align-items-start">
    <div class="col-sm-3 p-4 shadow p-3 mb-5 bg-body rounded" style="background-color: #fff; padding: 10px; margin-right: 20px; border-radius: 6px;">
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

    <div class="col-sm-8 p-3 shadow p-3 bg-body rounded" style="background-color: #fff; min-height: 580px; border-radius: 6px;">
      <table class="table table-hover">
        <thead class="table-light">
        <tr>
          <th scope="col" class="text-center">Name</th>
          <th scope="col" class="text-center">Surname</th>
          <th scope="col" class="text-center"><i class="fa fa-duotone fa-phone"></i> Phone</th>
          <th scope="col" class="text-center">Notes</th>
          <th scope="col" class="text-center">Edit</th>
          <th scope="col" class="text-center">Delete</th>
        </tr>
      </thead>

      <?php
      if (!isset($_GET['search'])) {
        $home_result = get_all_records_on_people($logged_id);
        $number_of_result = mysqli_num_rows($home_result);  // result of query that it executes  
      } else {
        $home_result = get_records_by_searhBar($logged_id,$_GET['search']);
        $number_of_result = mysqli_num_rows($home_result);  // result of query that it executes  
      }

      if ($number_of_result > 10) {
        include "includes/pag.php";
      } else {
        include "includes/short_list.php";
      }
      ?>
      </table>
    </div>

    <div class="col-sm-3"></div>
    <!-- este div se superpone al otro de 8 cols para ocultar la paginación para q quede fija-->
    <div class="col-sm-8" style="margin-top:-70px;"> 
      <?php if (isset($page)) { include "includes/pages.php"; } ?>
    </div>
  </div>


  <div class="row p-4 mb-5">
    <div class="col-sm-4"></div>
    <div class="col-sm-4 align-items-center">      
    </div>
  </div>
</div>
<?php include "includes/footer.php"; ?>