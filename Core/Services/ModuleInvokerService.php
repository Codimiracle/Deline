<?php
/**
 * Created by PhpStorm.
 * User: codimiracle
 * Date: 17-9-2
 * Time: 下午7:28
 */

namespace Core\Services;


use Core\Module\ModuleBinder;
use Core\Module\ModuleContainer;
use Core\Module\ModulePool;
use Core\Route\RouteMatcher;
use Core\Route\Router;

class ModuleInvokerService extends Service
{
    private static $module_binder;
    /**
     * @var ModulePool
     */
    private $module_pool;
    /**
     * @var Router
     */
    private $router;

    public function __construct()
    {
        $this->router = new Router();
        $this->module_pool = new ModulePool();
        if (is_null(self::$module_binder)) {
            self::$module_binder = new ModuleBinder();
        }
    }

    /**
     * @return ModulePool
     */
    public function getModulePool() {
        return $this->module_pool;
    }

    /**
     * @return Router
     */
    public function getRouter() {
        return $this->router;
    }
    /**
     * @param RouteMatcher $route_matcher
     * @param ModuleContainer $module_container
     */
    public function registry(RouteMatcher $route_matcher, ModuleContainer $module_container) {
        $this->router->appendRoute($route_matcher);
        $this->module_pool->put($module_container);
    }

    public function invoke() {
        $route = $this->router->getMatchRoute();
        if (is_null($route)) {
            echo "Page Not Found (404)";
            http_send_status(404);
        } else {
            $container = $this->module_pool->get($route->getMainNodeName());
            $module_call_args = $route->getSubNodePath();
            self::$module_binder->attach($container);
            self::$module_binder->send($module_call_args->getMainNodeName(), $module_call_args->getSubNodePath());
        }
    }


}