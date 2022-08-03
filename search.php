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

include_once "db.php";
$search_query = mysqli_query($conn,"SELECT * FROM people WHERE log_id = '$logged_id' AND (surname LIKE '%$value%' OR name LIKE '%$value%')");
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
    <div class="col-sm-12 p-3 shadow p-3 bg-body rounded" style="background-color: #fff; min-height: 580px; border-radius: 6px;">
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
        <?php include "includes/pag.php"; ?>
      </table>
    </div>
    <div class="col-sm-12" style="margin-top:-70px;"> 
      <?php include "includes/pages.php"; ?>
    </div>
  </div>


  <div class="row p-4 mb-5">
    <div class="col-sm-4"></div>
    <div class="col-sm-4 align-items-center">      
    </div>
  </div>
</div>
<?php include "includes/footer.php"; ?>