<div class="" style="">   
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
        <?php
        ?>
        <?php if ($page >= 2) { ?>   
            <li class="page-item"><a class="page-link" href="<?php echo 'home.php?page='.($page-1)?>">Previous</a></li> 
        <?php } ?> 
        <?php ?>
        <?php for ($i = 1; $i <= $number_of_pages; $i++) { ?>
            <?php if ($i==$page) { ?>
                <li class="page-item active" aria-current="page"><a class="page-link" href="<?php echo 'home.php?page='.$i?>"><?php echo $i ?></a></li>
            <?php } else { ?>
                <li class="page-item" aria-current="page"><a class="page-link" href="<?php echo 'home.php?page='.$i?>"><?php echo $i ?></a></li> 
            <?php } ?> 
        <?php } ?>	
        
        <?php if ($page < $number_of_pages) { ?> 
            <li class="page-item"><a class="page-link" href="<?php echo 'home.php?page='.($page+1)?>">Next</a></li>
        <?php } ?>  
        </ul>
    </nav>
    <?php
    /*
    echo '$page';
    var_dump($page);
    echo '$number_of_pages';
    var_dump($number_of_pages);
    */
    ?>
</div>