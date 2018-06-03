<?php
namespace Deline\Controller;

abstract class AbstractEntityController extends AbstractController
{

    public function onControllerStart()
    {
        $this->attachAction("/^\\/Append($|\\/$)/", "onEntityAppend");
        $this->attachAction("/^\\/$/", "onEntityList");
        $this->attachAction("/^\\/Pager\\/Count($|\\/$)/", "onEntityPagerCount");
        $this->attachAction("/^\\/Pager\\/[0-9]+($|\\/$)/", "onEntityPagerList");
        $this->attachAction("/^\\/Search($|\\/$)/", "onEntitySearch");
        $this->attachAction("/^\\/Search\\/Pager\\/Count($|\\/$)/", "onEntitySearchPagerCount");
        $this->attachAction("/^\\/Search\\/Pager\\/[0-9]+($|\\/$)/", "onEntitySearchPagerList");
        $this->attachAction("/^\\/[0-9]+($|\\/$)/", "onEntityDetails");
        $this->attachAction("/^\\/[0-9]+\\/Edit($|\\/$)/", "onEntityEdit");
        $this->attachAction("/^\\/[0-9]+\\/Delete($|\\/$)/", "onEntityDelete");
        $this->attachAction("/^\\/[0-9]+\\/Update($|\\/$)/", "onEntityUpdate");
    }

    /**
     * 获取实体ID
     *
     * @return int
     */
    public function getEntityId()
    {
        // "<id>/<operation>"
        $node = $this->getNodePath()->getMainNodeName();
        if (is_numeric($node)) {
            return intval($node);
        } else {
            return - 1;
        }
    }

    public function getPagerNumber()
    {
        // "Pager/<pagernumber>"
        $node = $this->getNodePath()
            ->getSubnodePath()
            ->getMainNodeName();
        if (is_numeric($node)) {
            return intval($node);
        } else {
            return 1;
        }
    }

    public function getSearchPagerNumber()
    {
        // "Search/Pager/<pagernumber>"
        $node = $this->getNodePath()
            ->getSubnodePath()
            ->getSubnodePath()
            ->getMainNodeName();
        if (is_numeric($node)) {
            return intval($node);
        } else {
            return 1;
        }
    }

    public function getSearchingKeyword()
    {
        return isset($_GET["kw"]) ? $_GET["kw"] : "";
    }

    public abstract function onEntityList();

    public abstract function onEntityPagerList();

    public abstract function onEntityPagerCount();

    public abstract function onEntityAppend();

    public abstract function onEntityEdit();

    public abstract function onEntityDelete();

    public abstract function onEntityDetails();

    public abstract function onEntitySearch();

    public abstract function onEntitySearchPagerList();

    public abstract function onEntitySearchPagerCount();
}
