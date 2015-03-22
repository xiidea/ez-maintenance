<?php

/*
 * This file is part of the EzMaintenance package.
 *
 * (c) Xiidea <http://www.xiidea.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EzMaintenance\Helper;

class Security
{
    const ENCRYPTION_KEY = 'FVbC#kx3=GBzuaNveh7x2Km';
    const COOKIE_NAME = 'EZ_MAINTENANCE_KEY';

    public static function hasValidGatePass($overrideKey)
    {
        $pass = self::getPassKey();

        if($pass) {
            return self::storeTheKeyIfValid($overrideKey, $pass);
        }

        return false;
    }

    /**
     * @return bool
     */
    private static function getPassKey()
    {
        if (isset($_COOKIE[self::COOKIE_NAME])) {
            return $_COOKIE[self::COOKIE_NAME];
        } elseif (isset($_GET['key'])) {
            return self::createPassKey($_GET['key']);
        }

        return false;
    }

    private static function createPassKey($str)
    {
        return substr(md5(self::tick() . $str . self::ENCRYPTION_KEY), -12, 10);
    }

    private static function tick()
    {
        return ceil(time() / (12 * 60 * 60));
    }

    private static function storeTheKeyIfValid($key, $pass)
    {
        if(self::isValidPass($key, $pass)) {
            return setcookie(self::COOKIE_NAME, $pass);
        }

        setcookie(self::COOKIE_NAME, "", time() - 3600);

        return false;
    }

    private static function isValidPass($str, $key)
    {
        return ($key == self::createPassKey($str));
    }

}