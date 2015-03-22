<?php

/*
 * This file is part of the EzMaintenance package.
 *
 * (c) Xiidea <http://www.xiidea.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
 
namespace EzMaintenance\Adapter;

abstract class BaseVariableAdapter implements AdapterInterface, VariableAdapterInterface
{
    public static function isTrue(array $options = array())
    {
        $options = self::getOptions($options);

        return static::checkVars($options['var_name'], $options['check_value']);
    }

    protected  static function getOptions(array $options) {
        return array_merge($options, array(
                'var_name' => 'APPLICATION_ENV',
                'check_value' => 'down',
            ));
    }
}