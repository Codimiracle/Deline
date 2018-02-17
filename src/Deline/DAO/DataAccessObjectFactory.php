<?php
/**
 * Created by PhpStorm.
 * User: codimiracle
 * Date: 18-1-19
 * Time: 下午3:56
 */

namespace CAstore\DAO;


use CAstore\Action\Context;

class DataAccessObjectFactory
{
    private static $daoes = array(
        "UserInfoDAO" => IUserInfoDAO::class,
        "AppInfoDAO" => IAppInfoDAO::class
    );

    /**
     * @param Context $context
     * @param $name
     * @return null
     */
    public static function getDataAccessObject($context, $name) {
        if (isset(self::$daoes[$name])) {
            $class = self::$daoes[$name];
            /** @var DataAccessObject $dao */
            $dao = new $class;
            $dao->setDataSource($context->getDataSource());
            return $dao;
        } else {
            return null;
        }
    }
}