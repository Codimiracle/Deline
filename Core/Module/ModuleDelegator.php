<?php
/**
 * Created by PhpStorm.
 * User: codimiracle
 * Date: 17-8-18
 * Time: 下午10:22
 */

namespace Core;


use Core\Module\ModulePool;

/**
 * Class ModuleDelegator
 * @package Core
 */
class ModuleDelegator
{
    /**
     * @var string
     */
    private $module_dir;
    private $autoloader;

    /**
     * ModuleDelegator constructor.
     * @param string $module_name
     */
    public function __construct($module_name)
    {
        $this->module_dir = __DIR__ . "/../../Modules/" . $module_name;
        $this->autoloader = require $this->module_dir."Autoloader.php";
    }

    public function load($class_name)
    {
        $this->autoloader->require($class_name);
    }
}