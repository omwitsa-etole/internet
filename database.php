<?php
$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));

define('DB_SERVER', "us-cdbr-east-05.cleardb.net");
define('DB_USERNAME', "bbee552e4676bf");
define('DB_PASSWORD', "1e9d6152");
define('DB_NAME', "heroku_f3ef71a21996103");
 

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>