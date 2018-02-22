<?php
namespace Deline\Component;

use Deline\View\HTMLRenderer;
use Deline\View\JSONRenderer;
use Deline\View\ResourceRenderer;

abstract class AbstractComponentCenter implements ComponentCenter
{

    protected $renderers = array(
        "html" => HTMLRenderer::class,
        "json" => JSONRenderer::class,
        "resource" => ResourceRenderer::class
    );

    protected $services = array();

    protected $controllers = array();

    protected $daos = array();

    /** @var Container **/
    private $container;

    /**
     * 获取当前用于创建组件的容器
     *
     * @return Container|null
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * 设置当前用于创建组件的容器
     *
     * @param Container $container
     */
    public function setContainer($container)
    {
        $this->container = $container;
    }

    private function getComponentClass($map, $name)
    {
        if (isset($map[$name])) {
            return $map[$name];
        } else {
            return null;
        }
    }

    public function getRenderer($type = "html")
    {
        $class = $this->getComponentClass($this->renderers, $type);
        return $class ? new $class() : null;
    }

    public function getDataAccessObject($name)
    {
        $class = $this->getComponentClass($this->daos, $name);
        return $class ? new $class() : null;
    }

    public function getController($name)
    {
        $class = $this->getComponentClass($this->controllers, $name);
        if ($class) {
            /** @var Controller $controller */
            $controller = new $class();
            $controller->setContainer($this->container);
            return $controller;
        } else {
            return null;
        }
    }

    public function getService($name)
    {
        $class = $this->getComponentClass($this->services, $name);
        if ($class) {
            /** @var Controller $controller */
            $controller = new $class();
            $controller->setContainer($this->container);
            return $controller;
        } else {
            return null;
        }
    }
}

