<?php
function get_home_url() {
    if ($_SERVER['SERVER_PORT']!='80') { $port=':'.$_SERVER['SERVER_PORT']; }
    $path = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://"; 
    $path .=$_SERVER["SERVER_NAME"] . $port;
    $path .= dirname($_SERVER["PHP_SELF"]). "/home.php";        
    return $path;
}

function has_notes($id) {
    include("db.php");
    $query = mysqli_query($conn, "SELECT COUNT(id) as total FROM `notes` WHERE people_id = $id");
    $total_of_notes=mysqli_fetch_assoc($query);
    $r = $total_of_notes['total'] > 0 ? true : false;
    return $r;
}

// queries
function get_all_records_on_people($id) {
    // Get total number of records on pepple table by logged_is
    include("db.php");
    $query = "SELECT * FROM people WHERE log_id = $id";
    return mysqli_query($conn, $query);
}

function get_records_by_searhBar($id) {
    // Get total number of records on pepple table by logged_is
    include("db.php");
    $query = "SELECT * FROM people WHERE log_id = $id AND (surname LIKE '%$value%' OR name LIKE '%$value%')";
    return mysqli_query($conn, $query);
}
?>