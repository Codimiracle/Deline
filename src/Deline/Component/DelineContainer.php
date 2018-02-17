<?php
/**
 * Created by PhpStorm.
 * User: codimiracle
 * Date: 18-1-21
 * Time: 下午8:48
 */

namespace CAstore\Component;


use CAstore\Action\AbstractAction;
use CAstore\Action\ActionFactory;
use CAstore\Action\Context;
use CAstore\Template\HTMLRenderer;
use CAstore\Template\JSONRenderer;
use CAstore\Template\Renderer;
use CAstore\Template\RendererCreator;
use CAstore\Template\RendererSetter;
use CAstore\Utils\IUserInfoDAO;

class DelineContainer implements Container
{
    /** @var  DataSource */
    private $dataSource = null;
    /** @var  NodePath */
    private $nodePath = null;
    /** @var  SessionManager */
    private $session = null;
    /** @var  Renderer */
    private $renderer = null;

    /** @var  bool */
    private $redirecting = false;

    /**
     * URL 重定向
     * @param string $node_pathname
     */
    public function redirect($node_pathname)
    {

        $this->redirecting = true;
        header("Location: index.php?".$this->getAccessingType()."=".$node_pathname);
    }
    /**
     * 请求分发
     * @param string $node_pathname
     */
    public function dispatch($node_pathname)
    {
        $this->nodePath = new NodePath($node_pathname);
        $this->handle($this->nodePath);
    }

    /**
     * 处理 NodePath
     * @param NodePath $node_path
     */
    public function handle($node_path)
    {
        global $logger;
        $logger->addDebug("retrieving NodePath",array("node" => strval($node_path)));
        $action_name = $node_path->getMainNodeName();
        if ($action_name == "") {
            return;
        }
        /** @var AbstractAction $action */
        $action = ComponentCenter::getAction($this, $action_name);
        if ($action) {
            try {
                $logger->addInfo("AbstractAction Start", array("AbstractAction Name"=> $action_name, "AbstractAction Class"=> get_class($action)));
                $action->onActionStart();
                $action->onActionHandle();
                $action->onActionEnd();
                $logger->addInfo("AbstractAction End");
                return;
            } catch (PermissionDeniedException $exception) {
                $logger->addWarning("AbstractAction invoking failed!", array("error-src" => $exception->getFile()));
                $this->dispatchPermissionDenied($exception->getMessage());
            } catch (\Exception $exception) {
                $logger->addWarning("AbstractAction invoking failed!", array("error-src" => $exception->getFile()));
                $this->dispatchPageError($exception->getMessage());
            }
        } else {
            $logger->addWarning("AbstractAction invoking failed!", array("message"=>"Page Not Found"));
            $this->dispatchPageNotFound();
        }
    }

    /**
     * @return DataSource
     */
    public function getDataSource()
    {
        if (is_null($this->dataSource)) {
            $this->dataSource = new MySQLDataSource();
        }
        return $this->dataSource;
    }

    /**
     * @return Renderer
     */
    public function getRenderer()
    {
        if (is_null($this->renderer)) {
            $this->renderer = RendererCreator::getRenderer($this->getRendererType());
        }
        return $this->renderer;
    }

    /**
     * @return SessionManager
     */
    public function getSession()
    {
        if (is_null($this->session)) {
            $this->session = new SessionManager();
        }
        return $this->session;
    }
    private function getAccessingType() {
        return isset($_GET["api"]) ? "api" : (isset($_GET["node"]) ? "node" : (isset($_GET["res"]) ? "res" : "node"));
    }
    private function getRendererType()
    {
        return isset($_GET["api"]) ? "json" : (isset($_GET["node"]) ? "html" : (isset($_GET["res"]) ? "resource" : "html"));
    }

    private function getNodePathname()
    {
        $type = $this->getAccessingType();
        return isset($_GET[$type]) ? $_GET[$type] : "/";
    }
    /**
     * @return NodePath
     */
    public function getNodePath()
    {
        if (is_null($this->nodePath)) {
            $node_pathname = $this->getNodePathname();
            $this->nodePath = new NodePath($node_pathname);
        }
        return $this->nodePath;
    }

    /**
     * 初始化容器
     */
    public function init()
    {
        $this->getSession()->setUserInfoDAO(ComponentCenter::getDataAccessObject($this, "UserInfoDAO"));
        $this->getSession()->setRoleInfoDAO(ComponentCenter::getDataAccessObject($this, "RoleInfoDAO"));
    }

    /**
     * @param string $message
     */
    public function dispatchPageError($message) {
        $this->dispatch("/System/PageError");
        $view = new RendererSetter($this->getRenderer());
        $view->setMessage("error", $message);
    }

    public function dispatchPageNotFound() {
        $this->dispatch("/System/PageNotFound");
    }

    public function dispatchPermissionDenied($message) {
        $this->dispatch("/System/PermissionDenied");
        $view = new RendererSetter($this->getRenderer());
        $view->setMessage("error", $message);
    }

    /**
     * 引发容器任务
     */
    public function invoke()
    {
        if ($this->getRendererType() == "resource") {
            $this->getRenderer()->setParameter("resource", $this->getNodePath());
            return;
        }
        global $logger;
        $node_path = null;
        try {
            /** @var NodePath $node_path */
            $node_path = $this->getNodePath();
            $action_name = $node_path->getMainNodeName();
            if ($action_name == "") {
                $this->dispatch(new NodePath("/Home"));
            } else {
                $this->dispatch($node_path);
            }
        } catch (NodePathFormatException $exception) {
            $logger->addError("Node Path Format Error", array("node" => $this->getNodePathname()));
            $this->dispatch(new NodePath("/System/NodePathError"));
        }
    }

    /**
     * 销毁容器
     */
    public function destroy()
    {
        if (!$this->redirecting) {
            $this->getRenderer()->render();
        }
    }
}