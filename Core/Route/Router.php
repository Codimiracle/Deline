<?php
/**
 * Created by PhpStorm.
 * User: codimiracle
 * Date: 17-8-18
 * Time: 下午4:23
 */

namespace Core\Route;


use Core\Route\NodePath;
use Core\Route\RouteMatcher;

class Router
{
    private $node_path;
    /**
     * @var array
     */
    private $route_matchers = array();

    public function __construct()
    {
        $this->node_path = new NodePath($_GET["node"]);
    }

    public function getNodePath() {
        return $this->node_path;
    }

    /**
     * @param $route_matcher RouteMatcher
     */
    public function appendRoute($route_matcher) {
        array_push($this->route_matchers, $route_matcher);
    }

    public function removeRoute() {

    }

    public function __404() {
        echo "Page Not Found";
    }


    public function route() {
        /**
         * @var $route_matcher RouteMatcher
         */
        foreach ($this->route_matchers as $route_matcher) {
            $tmp_node_path = $route_matcher->match($this->node_path);
            if (!is_null($tmp_node_path)) {
                $this->node_path = $tmp_node_path;

                break;
            }
        }
        $this->__404();
    }
}