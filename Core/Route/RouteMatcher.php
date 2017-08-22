<?php
/**
 * Created by PhpStorm.
 * User: codimiracle
 * Date: 17-8-18
 * Time: 下午4:32
 */

namespace Core\Route;


interface RouteMatcher
{
    /**
     * @return NodePath|null
     */
    public function match($node_path);
}