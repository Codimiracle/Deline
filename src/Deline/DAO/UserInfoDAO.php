<?php
/**
 * Created by PhpStorm.
 * User: codimiracle
 * Date: 18-1-17
 * Time: 下午9:13
 */

namespace CAstore\DAO;

interface UserInfoDAO extends DataAccessObject
{
    public function queryByRoleId();
    public function queryByName($name);
    public function queryByTag($tag);
}