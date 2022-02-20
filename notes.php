<?php
session_start();
//var_dump($_SESSION['msg_to_note']);

include_once "db.php";
if ($_GET) {
  $id = $_GET['id'];
  $select_query = mysqli_query($conn, "SELECT * FROM people WHERE id = '$id'");
  $row = mysqli_fetch_row($select_query);
}

if ($_POST) {
  var_dump($_POST);
  $title = $_POST['title'];
  $people_id = $_POST['people-id'];
  $content = $_POST['content'];
  $sql = mysqli_query($conn, "INSERT INTO notes (title, note, people_id) VALUES ('$title','$content','$people_id')");

  $_SESSION['msg_to_note']='note-created';

  header("Location: ".$_POST['uri']);
}

?>
<?php include "includes/header.php"; ?>
<div class="container-fluid">
  <div class="row align-items-center">    

    <?php
    if (isset($_SESSION['msg_to_note'])) { ?>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
      <script>
        setTimeout(function() { $('#success').fadeIn(1800,"swing"); }, 50);
        setTimeout(function() { $('#success').fadeOut(2000); }, 2850);
      </script>
    <?php if ($_SESSION['msg_to_note']=='note-edited') { 
        $text = "Changes were saved successfully"; ?>
    <?php  } elseif ($_SESSION['msg_to_note']=='note-deleted') {
      $text = 'Note deleted successfully'; ?>
    <?php  } elseif ($_SESSION['msg_to_note']=='note-created') {
      $text = 'New note were created successfully';
    } ?>

    <?php } ?>
    <?php $show_alert = isset($_SESSION['msg_to_note']) && strlen($_SESSION['msg_to_note'] > 0); ?>
    <?php if ($show_alert) { ?> 
      <div class="col text-center alert alert-success" role="alert" id="success" style="display: none;"><?php echo $text; ?></div>
    <?php } ?>

    <br><br>
  </div>
    <div class="row align-items-center mb-3">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
      <h4 class="text-center"><?php echo $row[1] . " " . $row[2] . " -> " . "Notes"; ?></h4>
    </div>
  </div>
</div>

<div class="container">
  <div class="row align-items-base">
    <div class="col-sm-1"></div>
    <div class="col-sm-4" style="background-color: #f2f4f4; padding: 10px; margin-right: 6px; border-radius: 6px;">

      <!-- create-note form -->
      <form action="notes.php" method="POST" class="p-2"> <!-- form header -->    <!-- wk here -->
        <input type="hidden" value="<?php echo $id;?>" name="people-id">
        <input type="hidden" value="<?php echo $_SERVER['REQUEST_URI']; ?>" name="uri">
        <div class="mb-3">
          <label for="inputName" class="form-label">Title</label>
          <input type="text" class="form-control border border-2" name="title">        
        </div>
        <div class="mb-3">
          <label for="exampleFormControlTextarea1" class="form-label">Content</label>
          <textarea class="form-control" id="exampleFormControlTextarea1" rows="10" name="content"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Add to notes</button>
      </form>

    </div>
    <div class="col-sm-6" style="background-color: #f2f4f4; border-radius: 6px;">          
      <!-- list of notes from contact -->
      <div class="mb-3 p-2">
        <table class="table table-striped">
          <thead>
          <tr>
            <th scope="col" class="text-center">Id</th>
            <th scope="col" class="text-center">Title</th>
            <th scope="col" class="text-center">Created</th>
            <th scope="col" class="text-center">Edit</th>
            <th scope="col" class="text-center">Delete</th>
          </tr>
          </thead>
          <tbody>            
            <?php
            $sql = mysqli_query($conn, "SELECT * FROM notes WHERE people_id='$id'");
            while ($data = mysqli_fetch_row($sql)) { ?>
              <tr>              
                <th scope="row"><?php echo $data[0] ?></th>
                <td><?php echo $data[1] ?></td>
                <td><?php echo $data[3] ?></td>
                <td class="text-center"><a href="edit-note.php?id=<?php echo $data[0]?>&ctid=<?php echo $id; ?>"><i class="far fa-edit"></i></a></td>
                <td class="text-center"><a href="delete.php?id=<?php echo $data[0]?>&which=note" onclick="return confirm('Do you want to delete this note? Y/N')"><i class="far fa-trash-alt"></i></a></td>
              </tr>              
            <?php } ?>          
          </tbody>   
        </table>
        <a href="home.php" class="btn btn-success">Back to home</a>
      </div>
    </div>
  </div>
</div>
<?php include "includes/footer.php"; ?>
