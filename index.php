<?php
/**
 * Created by PhpStorm.
 * User: codimiracle
 * Date: 17-8-21
 * Time: 下午2:44
 */
require_once "Core/Kernel.php";

use Core\Kernel;

$kenel = new \Core\Kernel();
$router = $kenel->getRouter();
$router->route();