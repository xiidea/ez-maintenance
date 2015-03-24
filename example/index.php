<?php

include_once("../autoload.php");

EzMaintenance\Worker::watch('file', array('override_key' => 'hard'));

//Your normal code
echo "Welcome to our site";
