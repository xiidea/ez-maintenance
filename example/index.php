<?php

include_once("../autoload.php");

EzMaintenance\Worker::watch('env', array(
        'template' => 'clock',
        'override_key' => 'hard',
    ));

//Your normal code
echo "Welcome to our site";

