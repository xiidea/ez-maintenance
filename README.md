Easy Maintenance
=================
Utility Library to handle site maintenance situation

Key Features
------------
* Easy to use
* Highly Customizable


## Installation/Usage

If you're using Composer to manage dependencies, you can include the following
in your composer.json file:

    "require": {
        "ronisaha/ez-maintenance": "dev-master"
    }

Then, after running `composer update` or `php composer.phar update`, you can
load the class using Composer's autoloading:

```php
require 'vendor/autoload.php';
```

Otherwise, you can simply require the given `autoload.php` file:

```php
require_once 'PATH_TO_LIBRARY/autoload.php';

```

Then you can just call `EzMaintenance\Worker::watch()` In your `index.php` (see the [example](https://github.com/ronisaha/ez-maintenance/blob/master/example/index.php))


## Different Adapters to check maintenance mode

##### File Adapters

This is the default adapter. it checks for a specific file if exist or not. default path is *down*. For the following implementation
you will be shown maintenance page if there is a file exists named `maintenance.enable`

```php
<?php

EzMaintenance\Worker::watch('file', array(
        'path' => 'maintenance.enable'
));


```

##### Env Adapters

Using this adapter you can watch over existence of an environment variable. The maintenance page will be shown if the environment
 variable is present with specific value.

```php
<?php

EzMaintenance\Worker::watch('env', array(
        'var_name' => 'APPLICATION_ENV',
        'check_value' => 'down'
));


```

##### Const Adapters

This is same ad the env adapter. Only difference is it will check for a php constant instead of environment variable.

```php
<?php

EzMaintenance\Worker::watch('const', array(
        'var_name' => 'APPLICATION_ENV',
        'check_value' => 'down'
));

```

##### Custom Adapters

You can define your own adapter by implementing the `EzMaintenance\Adapter\AdapterInterface`


### Common options

Following options are available to customize the behaviour of the library

##### interval

This option state the interval in second, the system will check for the site status with this interval. default is 5 second.

##### template

You can provide the builtin template name(simple, game, clock) or path to your own template file. All the options will also be available in your template.
You should `echo $javascript` in your template file to enable auto status check.

```php
<?php
    echo $javascript;
?>
```

##### msg

If you are using any of the default template, you can customize the message using this option.


## Contributing to Library

If you find a bug or want to add a feature to EzMaintenance, great! In order to make it easier and quicker for me to verify and merge changes in, it would be amazing if you could follow these few basic steps:

1. Fork the project.
2. **Branch out into a new branch. `git checkout -b name_of_new_feature_or_bug`**
3. Make your feature addition or bug fix.
4. Commit.
5. Send me a pull request!
