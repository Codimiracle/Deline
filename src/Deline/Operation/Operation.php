<?php
/**
 * Created by PhpStorm.
 * User: codimiracle
 * Date: 18-1-17
 * Time: 下午8:30
 */

namespace CAstore\Operation;


use CAstore\Action\Context;

interface Operation
{
    /**
     * @param Context $context
     */
    public function setContext($context);

    /**
     * @return Context
     */
    public function getContext();
}