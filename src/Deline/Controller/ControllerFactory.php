<?php
/**
 * Created by PhpStorm.
 * User: codimiracle
 * Date: 18-1-17
 * Time: 下午8:58
 */
namespace Deline\Controller;

interface ControllerFactory
{

    /**
     *
     * @param string $name
     *            动作名称
     * @return Controller
     */
    public function getController($name);
}
