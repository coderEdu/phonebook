<?php
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

  header("Location:".$_POST['prev']);

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
      <div class="row text-light p-4 align-items-center" style="border-bottom: 9px solid #6495ED; background-color: #607bab;">
        <div class="col-sm-1" style="width: 80px;">
          <img src="img/iPhone-icon.png" alt="" width="84">
        </div>
        <div class="col">
          <h2 style="display: inline;">Editing note: <?php echo " ".strtoupper('\''.$row[1].'\'')?></h2>
        </div>
      </div>
      
    </div>
    <div class="container">
      <br><br><br>
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
            <button type="submit" class="btn btn-success">Save changes</button>
          </form>
          
        </div>
      </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
