<?php
/**
 * Created by PhpStorm.
 * User: codimiracle
 * Date: 18-1-17
 * Time: 下午9:37
 */

namespace CAstore\Action;


class HomeAction extends AbstractAction
{

    public function onActionStart()
    {
        $this->attachAction("/^\\/$/", "onHoming");
        $this->attachAction("/^\\/Test$/", "onTest");
    }

    public function onHoming() {
        $this->view->setPageTitle("Home");
        $this->view->setPageName("home");
    }

    public function onTest() {
        $this->view->setPageTitle("Hello World");
        $this->view->setPageName("test");
        $this->view->setMessage("info", "Hello World");
    }

    public function onPageNotFound() {
        $this->onActionDefaultHandle();
    }

    public function onPageError() {
        $this->view->setPageTitle("Page Error");
        $this->view->setPageName("page-error");

    }
    public function onActionEnd()
    {
        // TODO: Implement onActionEnd() method.
    }
}