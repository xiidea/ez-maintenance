<?php

/*
 * This file is part of the EzMaintenance package.
 *
 * Copyright (c) 2015 Roni Saha
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */


namespace EzMaintenance;


use EzMaintenance\Adapter\AdapterInterface;
use EzMaintenance\Helper\Template;

class Worker {

    /** @var AdapterInterface[] $adapters */
    private static $adapters = array(
        'file' => '\EzMaintenance\Adapter\FileAdapter',
        'env' => '\EzMaintenance\Adapter\Environment',
        'const' => '\EzMaintenance\Adapter\Constant',
    );

    public static function watch($adapter = 'file', $options = array()){
        $adapterInterface = self::getAdapter($adapter);

        if($adapterInterface::isMaintenanceModeEnabled($options))
        {
            self::showMaintenancePage($options);
        }
    }

    private static function getAdapter($adapter)
    {
        if(isset(self::$adapters[$adapter])) {
            return self::$adapters[$adapter];
        }elseif(class_exists($adapter) && self::isImplementedAdapter($adapter)){
            return $adapter;
        }

        return self::$adapters['file'];
    }

    private static function isImplementedAdapter($adapter)
    {
        return in_array('EzMaintenance\Adapter\AdapterInterface', class_implements($adapter));
    }

    private static function showMaintenancePage($options)
    {
        $options = self::getOptions($options);
        Template::load($options);
        exit;
    }

    protected  static function getOptions(array $options) {
        return array_merge(array(
                'interval' => 5,
                'template' => 'simple',
                'msg' => 'Our site is currently undergoing maintenance!',
            ),$options);
    }
}