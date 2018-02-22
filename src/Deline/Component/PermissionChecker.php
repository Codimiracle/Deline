<?php
namespace Deline\Component;

class PermissionChecker
{

    const PERMISSION_ANONYMOUS = "anonymous";

    const PERMISSION_USER = "user";

    const PERMISSION_CONSOLE = "console";

    /**
     *
     * @var RoleInfo
     */
    private $role;

    /**
     *
     * @param
     *            $permission
     * @throws PermissionDeniedException
     */
    public function check($permission)
    {
        $result = strpos($this->role->getPermission(), $permission) != false;
        if ($result) {
            return;
        } else {
            
            throw new PermissionDeniedException("你没有 $permission 权限!!");
        }
    }
}