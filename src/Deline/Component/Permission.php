<?php
namespace Deline\Component;

interface Permission
{
    
    /**
     * 
     * @param Container $container
     */
    public function setContainer($container);
    public function getContainer();

    /**
     *
     * @return array
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

