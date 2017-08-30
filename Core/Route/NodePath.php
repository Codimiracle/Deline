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
    /**
     * retrieve each node name
     * @var array
     */
    private $nodes;
    /**
     * retrieve current node path.
     * @var string|null
     */
    private $node_pathname = null;

    /**
     * NodePath constructor.
     * @param string|array $node_pathname
     * node path like: "/View"
     * or array(["View"])
     */
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

    /**
     * get sub-node of the NodePath
     * @param int $index
     * @return NodePath
     */
    public function getSubNodePath($index = 1) {
        $temp = array_slice($this->nodes, $index);
        return new NodePath($temp);
    }

    /**
     * retrieve main node name equal as
     * NodePath->getNodeName(0)
     *
     * @return string
     */
    public function getMainNodeName() {
        return $this->getNodeName(0);
    }

    /**
     * set node name where index is.
     * @param integer $index
     * @param string $node_name
     */
    public function setNodeName($index, $node_name) {
        $this->nodes[$index] = $node_name;
        $this->node_pathname = null;
    }

    /**
     * retrieve node name that index is.
     * @param integer $index
     * @return string
     */
    public function getNodeName($index) {
        return $this->nodes[$index];
    }

    /**
     * get node path string.
     * @return string
     */
    public function __toString()
    {
        if (is_null($this->node_pathname)) {
            $this->node_pathname = "/".join("/", $this->nodes);
        }
        return $this->node_pathname;
    }

}