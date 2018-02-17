<?php
/**
 * Created by PhpStorm.
 * User: codimiracle
 * Date: 18-1-19
 * Time: 下午3:50
 */

namespace CAstore\DAO;


interface AppInfoDAO extends DataAccessObject
{
    public function queryByTag($tag);
    public function queryByDeveloper($developer);
    public function queryByKeyword($keyword);
    public function queryByPackage($package);
}