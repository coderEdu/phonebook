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
    include("db.php");
    $query = "SELECT * FROM people WHERE log_id = $id";
    return mysqli_query($conn, $query);
}

function get_records_by_searhBar($id,$val) {
    include("db.php");
    $query = "SELECT * FROM people WHERE log_id = $id AND (surname LIKE '%$val%' OR name LIKE '%$val%')";
    return mysqli_query($conn, $query);
}

function get_records_by_limit($id,$fr,$rpp) {
    include("db.php");
    $query = "SELECT * FROM people WHERE log_id = $id LIMIT " . $fr . ',' . $rpp; 
    return mysqli_query($conn, $query);
}

function get_filtered_records_by_limit($id,$val,$fr,$rpp) {
    include("db.php");
    $query = "SELECT * FROM people WHERE log_id = $id AND (surname LIKE '%$val%' OR name LIKE '%$val%') LIMIT " . $fr . ',' . $rpp;
    return mysqli_query($conn, $query);
}
?>