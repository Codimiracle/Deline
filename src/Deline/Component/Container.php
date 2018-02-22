<?php
namespace Deline\Component;

interface Container extends Context
{

    /**
     * 重定向
     *
     * @param string $node_pathname
     */
    public function redirect($node_pathname);

    /**
     * 请求分发
     *
     * @param string $node_pathname
     */
    public function dispatch($node_pathname);

    /**
     * 初始化容器
     */
    public function init();

    /**
     * 引发容器任务
     */
    public function invoke();

    /**
     * 销毁容器
     */
    public function destroy();
}