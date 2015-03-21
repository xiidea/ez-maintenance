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

class Template
{
    private static $templateDir;

    public static function load($___theDataArray = array())
    {
        self::header();

        $viewFile = self::getViewFile($___theDataArray['template']);
        unset($___theDataArray['template']);
        $___theDataArray['javascript'] = self::getScript($___theDataArray['interval']);

        echo self::getFileContent($viewFile, $___theDataArray);
    }

    public static function getScript($interval)
    {
        return self::getFileContent('__script', array('interval' => $interval));
    }

    private static function getFileContent($__template, $___theDataArray)
    {
        $viewFile = self::getViewFile($__template);
        extract($___theDataArray, EXTR_SKIP);
        unset($___theDataArray, $__template);
        ob_start();
        if (file_exists($viewFile)) {
            include $viewFile;
        }
        return ob_get_clean();
    }

    private static function getViewsDirectory()
    {
        if (self::$templateDir == "") {
            self::$templateDir = rtrim(realpath(dirname(__FILE__) . "/../"), DIRECTORY_SEPARATOR);
            self::$templateDir .= DIRECTORY_SEPARATOR . "Resources" . DIRECTORY_SEPARATOR . "templates" . DIRECTORY_SEPARATOR;
        }

        return self::$templateDir;
    }

    private static function getViewFile($___template_name)
    {
        if(file_exists($___template_name)) {
            return $___template_name;
        }

        return self::getViewsDirectory() . "{$___template_name}.php";
    }

    private static function header()
    {
        header('HTTP/1.1 503 Service Temporarily Unavailable');
        header('Status: 503 Service Temporarily Unavailable');
    }
}