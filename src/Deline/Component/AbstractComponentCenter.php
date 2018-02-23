<?php
namespace Deline\Component;

use Deline\View\HTMLRenderer;
use Deline\View\JSONRenderer;
use Deline\View\ResourceRenderer;
use Deline\Controller\SystemController;
use Deline\Service\Service;
use Deline\Model\DAO\DataAccessObject;
use Deline\View\Renderer;

abstract class AbstractComponentCenter implements ComponentCenter
{

    private $renderers = array(
        "html" => HTMLRenderer::class,
        "json" => JSONRenderer::class,
        "resource" => ResourceRenderer::class
    );

    private $services = array();

    private $controllers = array(
        "System" => SystemController::class
    );

    private $daos = array();

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

    /**
     * 获取所有的渲染器
     * @return multitype:string 
     */
    public function getRenderers()
    {
        return $this->renderers;
    }

    /**
     * 获取所有的服务
     * @return multitype:string
     */
    public function getServices()
    {
        return $this->services;
    }

    /**
     * 获取所有的控制器
     * @return multitype:string 
     */
    public function getControllers()
    {
        return $this->controllers;
    }

    /**
     * 获取所有数据访问对象
     * @return multitype:string
     */
    public function getDAOs()
    {
        return $this->daos;
    }

    /**
     * @param multitype:string  $renderers
     */
    public function setRenderers($renderers)
    {
        $this->renderers = $renderers;
    }

    /**
     * @param multitype:string $services
     */
    public function setServices($services)
    {
        $this->services = $services;
    }

    /**
     * @param multitype:string  $controllers
     */
    public function setControllers($controllers)
    {
        $this->controllers = $controllers;
    }

    /**
     * @param multitype:string $daos
     */
    public function setDAOs($daos)
    {
        $this->daos = $daos;
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
        if ($class) {
            /** @var Renderer $renderer **/
            $renderer = new $class;
            $renderer->setContainer($this->container);
            return $renderer;
        }
        return null;
    }

    public function getDataAccessObject($name)
    {
        $class = $this->getComponentClass($this->daos, $name);
        if ($class) {
            /** @var DataAccessObject  $dao **/
            $dao = new $class;
            $dao->setDataSource($this->container->getDataSource());
            return $dao;
        }
        return null;
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

