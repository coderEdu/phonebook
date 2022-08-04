<tbody>
    <?php include "db.php"; ?>
    <?php //$star_query = mysqli_query($conn, "SELECT * FROM people WHERE log_id = $logged_id"); ?>
    <?php
    
    // Get total number of pages by logged
    $query = "SELECT * FROM people WHERE log_id = $logged_id";  
    $result = mysqli_query($conn, $query);  
    //$number_of_result = mysqli_num_rows($result);  
    

    while ($data = mysqli_fetch_row($result)) { ?>
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