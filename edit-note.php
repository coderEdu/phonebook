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

include_once "db.php";
if ($_GET) {
  $id = $_GET['id'];
  $ctid = $_GET['ctid'];
  $sql = mysqli_query($conn, "SELECT * FROM notes WHERE id = '$id'");
  $row = mysqli_fetch_row($sql);

  $ct_name_sql = mysqli_query($conn, "SELECT * FROM people WHERE id = '$ctid'");
  $ct_row = mysqli_fetch_row($ct_name_sql);
}

if ($_POST) {
  $id = $_POST['id'];
  $title = addslashes($_POST['title']);
  $content = addslashes($_POST['content']);

  mysqli_query($conn, "UPDATE notes SET title = '$title', note = '$content' WHERE id = '$id'");

  $_SESSION['msg_to_note']="note-edited";
  
  header("Location:".$_POST['prev']);
}
?>
<?php include "includes/header.php"; ?>
<div class="container">
  <br><br>
  <div class="row align-items-center mb-3">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
      <h5 class="text-center" style="color: grey;"><?php echo $ct_row[1]." ".$ct_row[2] . " -> " . "Notes" . " -> " . $row[1]; ?></h5>
    </div>
  </div>
  <div class="row align-items-center">
    <div class="col-sm-4">
    </div>
    <div class="col-sm-4 shadow p-3 mb-5 bg-body rounded" style="background-color: #fff; border-radius: 6px;">

      <!-- edit and view a contact's note -->
      <form action="edit-note.php" method="POST" style="padding: 10px;"> <!-- form header -->
        <input type="hidden" value="<?php echo $_SERVER['HTTP_REFERER']; ?>" name="prev" /> 
        <div class="mb-3">
          <input type="text" class="form-control" name="id" value="<?php echo $row[0]; ?>" hidden>        
        </div>
        <div class="mb-3">
          <label for="inputName" class="form-label">Title</label>
          <input type="text" class="form-control border border-2" name="title" value="<?php echo $row[1]; ?>">        
        </div>
        <div class="mb-3">
          <label for="exampleFormControlTextarea1" class="form-label">Content</label>
          <textarea class="form-control" id="exampleFormControlTextarea1" rows="10" name="content"><?php echo $row[2];?></textarea>
        </div>
        <button type="submit" class="btn btn-danger">Save changes</button>
      </form>
      
    </div>
  </div>
</div>
<?php include "includes/footer.php"; ?>
