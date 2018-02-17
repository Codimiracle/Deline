<?php
/**
 * Created by PhpStorm.
 * User: codimiracle
 * Date: 18-1-30
 * Time: 下午9:10
 */

namespace CAstore\Operation;


interface AppOperation extends EntityOperation
{
    public function append($app_info);
    public function edit($app_info);
    
    public function delete($id);
    
    public function getAppInfoById($id);
    public function getAppInfoByPackage($package);
    public function getAppInfoByKeyword($keyword);
}
