<?php
/**
 * Created by PhpStorm.
 * User: codimiracle
 * Date: 18-2-16
 * Time: 下午12:21
 */

namespace CAstore\Entity;


use CAstore\Entity\Generable;
use CAstore\Entity\UserInfo;

class UserInfoGenerator extends EntityGenerator
{
    private $entity;
    
    public function __construct()
    {
        $this->entity = new UserInfo();
    }

    public function getFields()
    {
        return array("username", "");
    }
    public function getEntity()
    {
        return $this->entity;
    }
    
    public function generate()
    {
        $userInfo->setName($_POST["username"]);
        $userInfo->setNickname($_POST["nickname"]);
        $userInfo->setPassword(Security::password($_POST["password"]));
        $userInfo->setDescription(isset($_POST["description"]) ? $_POST["description"] : "");
        $userInfo->setGender($_POST["gender"]);
        return $userInfo;
    }
}
