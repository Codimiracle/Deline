<?php
namespace Deline\Controller;

use Exception;

class SystemController extends AbstractController
{

    public function onControllerStart()
    {
        $this->attachAction("/^\\/$/", "onSystemRoot");
        $this->attachAction("/^\\/Phpinfo$/", "onPhpInfo");
        $this->attachAction("/^\\/PageNotFound$/", "onPageNotFound");
        $this->attachAction("/^\\/PermissionDenied$/", "onPermissionDenied");
        $this->attachAction("/^\\/PageError$/", "onPageError");
        $this->attachAction("/^\\/NodePathError$/", "onNodePathError");
    }

    public function onSystemRoot()
    {
        $this->container->getAuthorization()->check("console");
        $this->view->setPageTitle("Dashboard");
        $this->view->setPageName("system.dashboard");
    }
    
    public function onPhpInfo()
    {
        $this->container->getAuthorization()->check("console");
        $this->view->setPageTitle("phpinfo");
        $this->view->setPageName("system.phpinfo");
    }

    public function onNodePathError()
    {
        $this->view->setPageTitle("Security");
        $this->view->setPageName("system.info");
        $this->view->setMessage("danger", "我们已经记录这个问题,并在一个工作日内调查问题原因。");
    }

    public function onPageNotFound()
    {
        $this->view->setPageTitle("Page Not Found");
        $this->view->setPageName("system.page-not-found");
        $this->view->setMessage("alert", "Page Not Found");
    }

    public function onPermissionDenied()
    {
        $this->view->setPageTitle("Permission Denied");
        $this->view->setPageName("system.info");
    }

    public function onPageError()
    {
        $this->view->setPageTitle("Page Error");
        $this->view->setPageName("system.page-error");
    }

    public function onControllerEnd()
    {}
}