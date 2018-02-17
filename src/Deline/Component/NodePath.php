<?php
/**
 * Created by PhpStorm.
 * Component: codimiracle
 * Date: 18-1-17
 * Time: 下午3:41
 */
namespace CAstore\Component;

class NodePath
{
    private $nodePath;

    private $nodes;

    public function __construct($node_path)
    {
        $isStandard = preg_match("/^(\\/[A-Za-z0-9]+)*[\\/]{0,1}$/", $node_path);
        if ($isStandard) {
            $this->nodePath = $node_path;
            $this->nodes = explode("/", substr($node_path, 1));
        } else {
            throw new NodePathFormatException("the '".$node_path."' is not a standard node path.");
        }
    }

    /**
     * get representation of the node path via String.
     * @return string
     */
    public function __toString()
    {
        if (count($this->nodes) == 0) {
            return "/";
        }
        return "/".implode("/", $this->nodes);
    }

    /**
     * 获取第一个节点名称
     * @return string
     */
    public function getMainNodeName() {
        return $this->nodes[0];
    }

    public function getSubnodePath($index = 1) {
        $nodes = array_slice($this->nodes,$index);
        return new NodePath("/".implode("/",$nodes));
    }

}