<?php
/**
 * Created by PhpStorm.
 * User: codimiracle
 * Date: 18-1-17
 * Time: 下午8:58
 */

namespace CAstore\Action;

class ActionFactory
{
    private static $actions = array(
        "Home" => HomeAction::class,
        "User" => UserAction::class,
        "Apps" => AppsAction::class,
        "About" => AboutAbstractAction::class,
        "System" => SystemAction::class
    );

    /**
     * @param $name
     * @param $context
     * @return AbstractAction
     */
    public static function getAction($context, $name) {
        if (isset(self::$actions[$name])) {
            $action_class = self::$actions[$name];
            /** @var AbstractAction $action */
            $action = new $action_class;
            $action->setContainer($context);
            return $action;
        } else {
            return null;
        }
    }
}