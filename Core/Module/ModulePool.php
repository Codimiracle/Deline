<?php
/**
 * Created by PhpStorm.
 * User: codimiracle
 * Date: 17-8-18
 * Time: 下午3:59
 */

namespace Core\Module;

/**
 * Class ModulePool
 * save Module autoloader
 * @package Core\Module
 */
class ModulePool
{
    /**
     * @var array
     */
    private $modules;

    /**
     * ModulePool constructor.
     *
     */
    public function __construct()
    {
        $this->modules = array();
    }

    /**
     * @param $name string
     * @param $value Binder
     */
    public function put($name, Binder $value)
    {
        $pool[$name] = $value;
    }

    /**
     * @param $name
     * @return Binder
     */
    public function get($name)
    {
        return $this->modules[$name];
    }

    /**
     * @param $name
     * @return bool
     */
    public function has($name)
    {
        return isset($this->modules[$name]);
    }

    public function remove($name)
    {
        unset($this->modules[$name]);
    }
}