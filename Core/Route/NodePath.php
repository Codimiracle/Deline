<?php
/**
 * Created by PhpStorm.
 * User: codimiracle
 * Date: 17-8-18
 * Time: 下午9:53
 */

namespace Core\Route;


class NodePath
{
    private $nodes;
    private $node_pathname = null;

    public function __construct($node_pathname)
    {
        if (is_array($node_pathname)) {
            $this->nodes = $node_pathname;
        } else {
            $this->nodes = str_getcsv($node_pathname,"/");
            if ($this->nodes[0] == "") {
                array_shift($this->nodes);
            }
        }

    }

    public function getSubNodePath($index = 1) {
        $temp = array_slice($this->nodes, $index);
        return new NodePath($temp);
    }

    public function getNodeName() {
        return $this->nodes[0];
    }

    public function __toString()
    {
        if (is_null($this->node_pathname)) {
            $this->node_pathname = join("/", $this->nodes);
        }
        return $this->node_pathname;
    }

}