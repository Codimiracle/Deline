<?php
/**
 * Created by PhpStorm.
 * User: codimiracle
 * Date: 17-8-18
 * Time: 下午3:56
 */

namespace Core;


use Core\Module\Binder;
use Core\Module\ModulePool;
use Core\Route\Router;

class Kernel
{
    /**
     * @var ModulePool
     */
    private static $pool = null;

    /**
     * @var Router
     */
    private static $router = null;

    public function __construct()
    {
        if (is_null(self::$pool)) {
            self::$pool = new ModulePool() ;
        }

        if (is_null(self::$router)) {
            self::$router = new Router();
        }
    }

    /**
     * @return ModulePool
     */
    public function getPool()
    {
        return self::$pool;
    }

    /**
     * @return Router
     */
    public function getRouter()
    {
        return self::$router;
    }

}