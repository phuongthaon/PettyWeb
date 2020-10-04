<?php 
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'id13471755_root');
define('DB_PASSWORD', 't7jMkBfId*c!)U\?');
define('DB_NAME','id13471755_petty');

define('MAX_PRODUCT_IN_PAGE', 20);
define('MAX_PAGE_NUMBER_IN_PAGE', 5);
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 mysqli_set_charset($link, 'UTF8');
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 ?>