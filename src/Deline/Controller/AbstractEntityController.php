<?php

namespace Deline\Controller;

abstract class AbstractEntityController extends AbstractController
{

    public function onActionStart()
    {
        $this->attachAction("/^\\/Append$/", "onEntityAppend");
        $this->attachAction("/^\\/[0-9]+$/", "onEntityDetails");
        $this->attachAction("/^\\/[0-9]+\\/Edit$/", "onEntityEdit");
        $this->attachAction("/^\\/[0-9]+\\/Delete/", "onEntityDelete");
        $this->attachAction("/^\\/[0-9]+\\/Update/", "onEntityUpdate");
    }

    /**
     * 获取实体ID
     * 
     * @return int
     */
    public function getEntityId()
    {
        $node = $this->getNodePath()->getMainNodeName();
        if (is_numeric($node)) {
            return intval($node);
        } else {
            return - 1;
        }
    }

    public abstract function onEntityAppend();

    public abstract function onEntityEdit();

    public abstract function onEntityDelete();

    public abstract function onEntityUpdate();

    public abstract function onEntityDetails();
}
