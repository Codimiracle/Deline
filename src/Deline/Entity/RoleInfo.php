<?php
/**
 * Created by PhpStorm.
 * User: codimiracle
 * Date: 18-1-28
 * Time: 下午10:59
 */

namespace CAstore\Entity;


class RoleInfo implements Entity
{
    public $id;
    public $permission;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getPermission()
    {
        return $this->permission;
    }

    /**
     * @param string $permission
     */
    public function setPermission($permission)
    {
        $this->permission = $permission;
    }


}