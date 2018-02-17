<?php
/**
 * Created by PhpStorm.
 * User: codimiracle
 * Date: 18-2-3
 * Time: 下午3:12
 */

namespace CAstore\Operation;


class OperationFactory
{
    private static $operations = array(
        "UserOperation" => IUserOperation::class,
        "AppOperation" => IAppOperation::class
    );
    /**
     * @param $context
     * @param $name
     * @return Operation
     */
    public static function getOperation($context, $name) {
        if (isset(self::$operations[$name])) {
            $operation_class = self::$operations[$name];
            /** @var Operation $operation */
            $operation = new $operation_class;
            $operation->setContext($context);
            return $operation;
        } else {
            return null;
        }
    }
}