<?php
session_start();

include_once "db.php";
if ($_GET) {
  $id = $_GET['id'];
  $sql = mysqli_query($conn, "SELECT * FROM notes WHERE id = '$id'");
  $row = mysqli_fetch_row($sql);
}

if ($_POST) {
  $id = $_POST['id'];
  $title = $_POST['title'];
  $content = $_POST['content'];

  mysqli_query($conn, "UPDATE notes SET title = '$title', note = '$content' WHERE id = '$id'");

  if (isset($_POST['note-edited'])) {
    $_SESSION['message']="note-edited";
  }
  
  header("Location:".$_POST['prev']);
}
?>
<?php include "includes/header.php"; ?>
<div class="container">
  <br><br>
  <div class="row align-items-center">
    <div class="col-sm-3">
    </div>
    <div class="col-sm-6" style="background-color: #f2f4f4; border-radius: 6px;">
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
        <input type="text" name="note-edited" hidden>
        <button type="submit" class="btn btn-success">Save changes</button>
      </form>
      
    </div>
  </div>
</div>
<?php include "includes/footer.php"; ?>
