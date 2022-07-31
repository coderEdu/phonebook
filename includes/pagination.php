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
$number_of_page = ceil ($number_of_result / $results_per_page);

// Retrieve data and display on webpage
// The below code is used to retrieve the data from database and display on the webpages that are divided accordingly.
$query = "SELECT * FROM people WHERE log_id = $logged_id LIMIT " . $page_first_result . ',' . $results_per_page;  
$result = mysqli_query($conn, $query);  
  
//display the retrieved result on the webpage  
while ($row = mysqli_fetch_array($result)) {  
	echo $row['id'] . ' ' . $row['name'] . $row['surname'] . $row['phone'].'</br>';  
}

// Display the link of the pages in URL
// Using this code URL of the webpage will change for each page.
for($page = 1; $page<= $number_of_page; $page++) {  
  echo '<a href = "home.php?page=' . $page . '">' . $page . ' </a>'; 
}	
?>
<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#">Next</a></li>
  </ul>
</nav>