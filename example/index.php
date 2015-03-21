<?php

include_once("../autoload.php");

EzMaintenance\Worker::watch('env', array(
        'template' => 'clock'
    ));

//Your normal code
echo "Welcome to our site";

