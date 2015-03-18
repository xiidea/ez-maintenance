<?php
define('APPLICATION_ENV', getenv('APPLICATION_ENV'));

if(APPLICATION_ENV == 'down') {
    include_once("maintenance.php");
    exit;
}


//Your normal code
echo "Welcome to our site";

