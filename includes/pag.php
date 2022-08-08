<?php
if(!isset($_GET['page'])) {
	$page=1;
} else {
	$page=$_GET['page'];
}

$results_per_page = 10;  
$page_first_result = ($page-1) * $results_per_page; 

// Get total number of pages by logged
$query = "SELECT * FROM people WHERE log_id = $logged_id";  
$result = mysqli_query($conn, $query);  
$number_of_result = mysqli_num_rows($result);  
  
// determine the total number of pages available  
$number_of_pages = ceil ($number_of_result / $results_per_page);
$pagLink = "";

// Retrieve data and display on webpage
// The below code is used to retrieve the data from database and display on the webpages that are divided accordingly.
$query = "SELECT * FROM people WHERE log_id = $logged_id LIMIT " . $page_first_result . ',' . $results_per_page;  
$result = mysqli_query($conn, $query);  
  
//display the retrieved result on the webpage  
//while ($row = mysqli_fetch_array($result)) {  
//	echo $row['id'] . ' ' . $row['name'] . $row['surname'] . $row['phone'].'</br>';  
//}
?>
<tbody>
    <?php include "db.php"; ?>
    <?php //$star_query = mysqli_query($conn, "SELECT * FROM people WHERE log_id = $logged_id"); ?>
    <?php

    if ($value=='') {
        $sql = $result;
    } else {
        $sql = $search_query;
        //header ("../search.php");
    }

    while ($data = mysqli_fetch_row($sql)) { ?>
        <tr>              
        <th scope="row" class="text-center" hidden><?php echo $data[0] ?></th>
        <td class="text-center"><?php echo $data[1] ?></td>
        <td class="text-center"><?php echo $data[2] ?></td>
        <td class="text-center"><?php echo $data[3] ?></td>

        <?php include_once "includes/functions.php"; ?>

        <?php if ($result=has_notes($data[0])==true) { ?>
            <td class="text-center"><a href="notes.php?id=<?php echo $data[0]?>"><i class="far fa-clipboard"></i></a></td>
        <?php } else {?>
            <td class="text-center"><a href="notes.php?id=<?php echo $data[0]?>"><i class="fa-solid fa-transporter-empty"></i></a></td>
        <?php } ?>
        <td class="text-center"><a href="edit.php?id=<?php echo $data[0]?>"><i class="far fa-edit"></i></a></td>
        <td class="text-center"><a href="delete.php?id=<?php echo $data[0]?>&which=contact" onclick="return confirm('Do you want to delete this contact? Y/N')"><i class="far fa-trash-alt"></i></a></td>
        </tr>   
    <?php } ?>
</tbody>   

