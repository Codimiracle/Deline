<?php
/**
 * Created by PhpStorm.
 * User: codimiracle
 * Date: 18-1-30
 * Time: 下午3:45
 */

namespace CAstore\Action;

use CAstore\Component\DelineContainer;
use CAstore\Component\ComponentCenter;
use CAstore\Component\Security;
use CAstore\Operation\UserOperation;
use CAstore\Entity\UserInfo;
use CAstore\Verifier\UserSignUpVerifier;

class UserAction extends AbstractAction
{
    const SUBMIT_ID_USER_SIGN_IN = "user_sign_in";
    const SUBMIT_ID_USER_SIGN_UP = "user_sign_up";
    const SUBMIT_ID_USER_SIGN_OUT = "user_sign_out";

    const USER_SIGN_IN_MESSAGE = "user_sign_out_message";

    /**
     * @var UserOperation
     */
    private $userOperation;

    public function onActionStart()
    {
        $this->attachAction("/^\\/$/", "onUserRoot");
        $this->attachAction("/^\\/SignUp$/", "onUserSignUp");
        $this->attachAction("/^\\/SignIn$/", "onUserSignIn");
        $this->attachAction("/^\\/SignOut$/", "onUserSignOut");

        $this->userOperation = ComponentCenter::getOperation($this->container, "UserOperation");
    }

    public function onUserRoot()
    {
        if (!$this->container->getSession()->isLogged()) {
            $this->container->getSession()->setParameter(self::USER_SIGN_IN_MESSAGE, "你必须先登录才能查看您的信息！");
            $this->container->redirect("/User/SignIn");
            return;
        }
        $this->view->setPageTitle("个人中心");
        $this->view->setPageName("user.main");
        $this->view->setData("userdata", $this->userOperation->getUserData());
    }

    //处理用户注册
    public function onUserSignUp()
    {
        $message = null;
        $this->view->setPageTitle("注册");
        $this->view->setPageName("user.sign-up");
        if ($this->isSubmit(self::SUBMIT_ID_USER_SIGN_UP)) {
            //生成验证器
            $userVerifier = new UserSignUpVerifier();
            //验证所有必须字段（nickname跳过了空的情况）
            $userVerifier->verifyAll();
            //验证通过
            if ($userVerifier->isValidity()) {
                try {
                    //生成对应的用户信息
                    $userInfo = new UserInfo();
                    $userInfo->setName($_POST["username"]);
                    $userInfo->setNickname($_POST["nickname"]);
                    $userInfo->setPassword(Security::password($_POST["password"]));
                    $userInfo->setDescription(isset($_POST["description"]) ? $_POST["description"] : "");
                    $userInfo->setGender($_POST["gender"]);
                    $userInfo->setRoleId(1); //普通用户
                    //调用业务处理
                    $result = $this->userOperation->signUp($userInfo);
                    if ($result == 1) {
                        $message = "注册成功";
                        $this->view->setPageName("system.info");
                    } else if ($result == 0) {
                        $message = "注册失败：用户已经存在！";
                    } else { //$result == -1
                        $message = "注册失败：系统内部异常！";
                    }
                } catch (\Exception $exception) {
                    $message = $exception->getMessage();
                }
            } else {
                $message = $userVerifier->getResultMessage();
            }
        }
        $this->view->setMessage("info", $message);
    }

    //处理用户登录
    public function onUserSignIn()
    {
        $this->view->setPageTitle("登录");
        $session = $this->container->getSession();
        if ($session->isLogged()) {
            $this->view->setPageName("system.info");
            $this->view->setMessage("info", "你已经登录啦！");
            return;
        } else {
            $this->view->setPageName("user.sign-in");
        }
        $message = $session->getParameter(self::USER_SIGN_IN_MESSAGE);
        $session->setParameter(self::USER_SIGN_IN_MESSAGE, null);
        if ($this->isSubmit(self::SUBMIT_ID_USER_SIGN_IN)) {
            $username = $_POST["username"];
            $password = $_POST["password"];
            $verifier = $_POST["verifier"];
            try {
                $result = $this->userOperation->signIn($username, $password);
                if ($result == 1) { // 登录成功
                    $this->view->setPageName("system.info");
                    $message = "登录成功";
                } else { //用户不存在或密码错误
                    $message = "用户名或密码不正确！";
                }
            } catch (\RuntimeException $exception) {
                $message = $exception->getMessage();
            }
        }

        $this->view->setMessage("info",$message);
    }

    public function onUserSignOut()
    {
        $success = $this->userOperation->signOut();
        if ($success) {
            $message = "你已成功退出登录！";
            $this->view->setPageTitle("登出");
            $this->view->setMessage("info", $message);
        } else {
            /** @var DelineContainer $context */
            $context = $this->container;
            $message = "你必须先登录才能注销登录！";
            $context->getSession()->setParameter(self::USER_SIGN_IN_MESSAGE, $message);
            $context->redirect("/User/SignIn");
        }

    }

    public function onActionEnd()
    {

    }
}