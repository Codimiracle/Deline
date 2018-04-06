<?php
namespace Deline\View;

interface Renderer
{

    public function setContainer($container);

    public function getContainer();

    /**
     * 设置 Renderer 的属性
     *
     * @param
     *            $attribute_name
     * @param
     *            $attribute_value
     */
    public function setAttribute($attribute_name, $attribute_value);

    /**
     * 获取 Renderer 的属性
     *
     * @param
     *            $attribute_name
     * @return mixed
     */
    public function getAttribute($attribute_name);

    /**
     * 设置 Renderer 渲染参数
     *
     * @param
     *            $parameter_name
     * @param
     *            $parameter_value
     */
    public function setParameter($parameter_name, $parameter_value);

    /**
     * 获取 Renderer 渲染参数
     *
     * @param
     *            $parameter_name
     * @return mixed
     */
    public function getParameter($parameter_name);

    public function render();
}