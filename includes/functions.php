<?php
function get_home_url() {
    $path = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
    $path .=$_SERVER["SERVER_NAME"]. dirname($_SERVER["PHP_SELF"]). "/home.php";        
    return $path;
}
?>