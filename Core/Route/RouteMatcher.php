<?php
/**
 * Created by PhpStorm.
 * User: codimiracle
 * Date: 17-8-18
 * Time: 下午4:32
 */

namespace Core\Route;

/**
 * Interface RouteMatcher
 * It provides simple route for URL
 */
interface RouteMatcher
{

    /**
     * Get the Route Name.
     * @return string
     */
    public function getName();
    /**
     * Match Route Ruler.
     * @param NodePath $node_path
     * @return NodePath|null
     */
    public function match($node_path);

}