<?php
namespace Deline\View;

use Deline\Component\Container;

class ResourceRenderer implements Renderer
{

    private $mapping = array();

    private $container;

    /**
     *
     * @return Container
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     *
     * @param Container $container
     */
    public function setContainer($container)
    {
        $this->container = $container;
    }

    /**
     * 设置 Renderer 的属性
     *
     * @param
     *            $attribute_name
     * @param
     *            $attribute_value
     */
    public function setAttribute($attribute_name, $attribute_value)
    {}

    /**
     * 获取 Renderer 的属性
     *
     * @param
     *            $attribute_name
     * @return mixed
     */
    public function getAttribute($attribute_name)
    {}

    /**
     * 设置 Renderer 渲染参数
     *
     * @param
     *            $parameter_name
     * @param
     *            $parameter_value
     */
    public function setParameter($parameter_name, $parameter_value)
    {
        $this->mapping[$parameter_name] = $parameter_value;
    }

    /**
     * 获取 Renderer 渲染参数
     *
     * @param
     *            $parameter_name
     * @return mixed
     */
    public function getParameter($parameter_name)
    {
        return $this->mapping[$parameter_name];
    }

    public function render()
    {
        echo "resource:" . $this->mapping["resource"];
    }
}