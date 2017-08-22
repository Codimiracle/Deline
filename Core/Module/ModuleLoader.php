<?php
/**
 * Created by PhpStorm.
 * User: codimiracle
 * Date: 17-8-18
 * Time: 下午10:22
 */

namespace Core;


use Core\Module\ModulePool;

class ModuleLoader
{
    private static $module_dir = __DIR__ . "/../../Modules/";
    /**
     * @var ModulePool
     */
    private static $module_pool;

    /**
     * @param $module_pool ModulePool
     */
    public static function setModulePool($module_pool) {
        self::$module_pool = $module_pool;
    }
    public static function load($module_name) {
        $package = json_decode(self::$module_dir.$module_name."package.json");
        echo $package;
    }
}