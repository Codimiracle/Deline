<?php
namespace Deline\Component;

interface Authorization
{

    /**
     *
     * @param Container $container
     */
    public function setContainer($container);

    public function getContainer();

    /**
     *
     * @param multitype:string $permissions
     */
    public function setPermissions($permissions);

    /**
     *
     * @return multitype:string
     */
    public function getPermissions();

    /**
     *
     * @param string $permission
     */
    public function grant($permission);

    /**
     *
     * @param string $premission
     */
    public function revoke($premission);

    /**
     *
     * @param string $permission
     * @throws PermissionException
     */
    public function check($permission);
}

