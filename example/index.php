<?php

include_once("../autoload.php");
define('APPLICATION_ENV', 'down');

EzMaintenance\Worker::watch('const', array(
        'template' => 'clock'
    ));

//Your normal code
echo "Welcome to our site";

