<?php
/**
 * Created by PhpStorm.
 * User: codimiracle
 * Date: 17-8-21
 * Time: 下午2:44
 */
require_once "Core/Kernel.php";

use Core\Kernel;

function __autoload($class_name)
{
    $path = explode("\\",$class_name);
    $class_path = join("/",$path);
    require_once $class_path.".php";
}

$kernel = new Kernel();
$kernel->launch();
