<?php
/**
 * Created by PhpStorm.
 * User: codimiracle
 * Date: 18-1-17
 * Time: 下午3:57
 */
namespace CAstore\Component;

use CAstore\DAO\RoleInfoDAO;
use CAstore\DAO\UserInfo;
use CAstore\DAO\UserInfoDAO;

class SessionManager
{
    const ANONYMOUS_ROLE_ID = 1;
    const SESSION_LOGGED_USER = "logged_user";

    /** @var  UserInfoDAO */
    private $userInfoDAO;
    /** @var  RoleInfoDAO */
    private $roleInfoDAO;

    public function __construct()
    {
        if (session_id() == "") {
            session_start();
        }
    }

    /**
     * @return RoleInfoDAO
     */
    public function getRoleInfoDAO()
    {
        return $this->roleInfoDAO;
    }

    /**
     * @param RoleInfoDAO $role_info_dAO
     */
    public function setRoleInfoDAO($role_info_dAO)
    {
        $this->roleInfoDAO = $role_info_dAO;
    }


    /**
     * @param UserInfoDAO $user_info_dao
     */
    public function setUserInfoDAO($user_info_dao) {
        $this->userInfoDAO = $user_info_dao;
    }
    /**
     * @param UserInfo $user_info
     */
    public function setUserInfo($user_info) {
        $_SESSION[self::SESSION_LOGGED_USER] = $user_info;
    }

    /**
     * @return UserInfo
     */
    public function getUserInfo() {
        return $_SESSION[self::SESSION_LOGGED_USER];
    }

    public function getRoleInfo() {
        $roleId = null;
        if ($this->isLogged()) {
            $roleId = $this->getUserInfo()->getRoleId();
        } else {
            // 匿名用户角色
            $roleId = self::ANONYMOUS_ROLE_ID;
        }
        return $this->roleInfoDAO->queryById($roleId);
    }

    /**
     * 设置会话参数
     * @param string $key
     * @param mixed $value
     */
    public function setParameter($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * 获取会话参数
     * @param $key
     * @return mixed|null
     */
    public function getParameter($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return null;
        }
    }

    /**
     * 登录会话
     * @param string $username
     * @param string $password
     */
    public function login($username, $password)
    {
        /** @var UserInfo $user */
        $user = $this->userInfoDAO->queryByName($username);
        if ($user && $user->getPassword() == Security::password($password)) {
            $this->setUserInfo($user);
        } else {
            $this->setUserInfo(null);
            throw new \RuntimeException("登录失败，密码或用户名不正确！");
        }
    }

    /**
     * 会话已登录
     * @return bool
     */
    public function isLogged() {
        return isset($_SESSION[self::SESSION_LOGGED_USER]) && !is_null($_SESSION[self::SESSION_LOGGED_USER]);
    }

    /**
     * 销毁会话
     */
    public function logout()
    {
        session_destroy();
    }
}