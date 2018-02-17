<?php
/**
 * Created by PhpStorm.
 * User: codimiracle
 * Date: 18-2-3
 * Time: 下午3:00
 */

namespace CAstore\Component;


use CAstore\Action\ActionFactory;
use CAstore\Operation\OperationFactory;
use CAstore\DAO\DataAccessObjectFactory;

class ComponentCenter
{
    public static function getDataAccessObject($context, $name)
    {
        return DataAccessObjectFactory::getDataAccessObject($context, $name);
    }
    public static function getAction($context, $name)
    {
        return ActionFactory::getAction($context, $name);
    }
    public static function getOperation($context, $name)
    {
        return OperationFactory::getOperation($context, $name);
    }
}