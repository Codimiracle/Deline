<?php
/**
 * Created by PhpStorm.
 * User: codimiracle
 * Date: 18-1-18
 * Time: 下午8:25
 */

namespace CAstore\Component;

use CAstore\Action\Context;

interface Container extends Context
{
    /**
     * URL 重定向
     * @param string $node_pathname
     */
    public function redirect($node_pathname);

    /**
     * 请求分发
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