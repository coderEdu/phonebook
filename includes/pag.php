<?php
if(!isset($_GET['page'])) {
	$page=1;
} else {
	$page=$_GET['page'];
}
include ("db.php");
$results_per_page = 10;  
$page_first_result = ($page-1) * $results_per_page; 
  
// determine the total number of pages available  
$number_of_pages = ceil ($number_of_result / $results_per_page);
$pagLink = "";

// Retrieve data and display on webpage
// The below code is used to retrieve the data from database and display on the webpages that are divided accordingly.
if (!isset($_GET['search'])) {
    $pag_result = get_records_by_limit($logged_id,$page_first_result,$results_per_page);  
} else {
    $pag_result = get_filtered_records_by_limit($logged_id,$_GET['search'],$page_first_result,$results_per_page); 
}

//display the retrieved result on the webpage  
?>
<tbody>
    <?php
    while ($data = mysqli_fetch_row($pag_result)) { ?>
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