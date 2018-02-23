<?php
namespace Deline\Component;


class DelinePermission implements Permission
{

    const SESSION_PERMISSION = "permissions";

    private $container;

    /**
     *
     * @return Container
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     *
     * @param Container $container
     */
    public function setContainer($container)
    {
        $this->container = $container;
    }

    public function revoke($permission)
    {
        $permissions = $this->getPermissions();
        $index = array_search($permission, $permissions);
        if (!is_null($index)) {
            unset($permissions[$index]);
            $this->container->getSession()->setParameter(self::SESSION_PERMISSION, $permissions);
        }
    }

    public function check($permission)
    {
        $granted = array_search($permission, $this->getPermissions());
        if (!$granted) {
            throw new PermissionException("你需要 ".$permission." 权限才能访问！");
        }
    }

    public function grant($permission)
    {
        $permissons = $this->getPermissions();
        array_push($permissons, $permission);
        $this->container->getSession()->setParameter(self::SESSION_PERMISSION, $permissons);
    }

    public function getPermissions()
    {
        return $this->container->getSession()->getParameter(self::SESSION_PERMISSION);
    }
}