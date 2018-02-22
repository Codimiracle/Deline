<?php
namespace Deline\Component;

use Deline\Model\Database\DataSource;
use Deline\Model\Database\MySQLDataSource;
use Deline\View\Renderer;
use Deline\View\RendererSetter;

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

    /** @var ComponentCenter */
    private $componentCenter;

    /**
     *
     * @return ComponentCenter
     */
    public function getComponentCenter()
    {
        return $this->componentCenter;
    }

    /**
     *
     * @param ComponentCenter $componentCenter
     */
    public function setComponentCenter($componentCenter)
    {
        $this->componentCenter = $componentCenter;
    }

    /**
     * 重定向
     *
     * @param string $node_pathname
     */
    public function redirect($node_pathname)
    {
        $this->redirecting = true;
        header("Location: index.php?" . $this->getAccessingType() . "=" . $node_pathname);
    }

    /**
     * 请求分发
     *
     * @param string $node_pathname
     */
    public function dispatch($node_pathname)
    {
        if (is_string($node_pathname)) {
            $this->nodePath = new NodePath($node_pathname);
        } else {
            $this->nodePath = $node_pathname;
        }
        $this->handle($this->nodePath);
    }

    /**
     * 处理 NodePath
     *
     * @param NodePath $node_path
     */
    public function handle($node_path)
    {
        global $logger;
        $logger->addDebug("DelineContainer", array(
            "procedure" => "handle",
            "node_pathname" => $this->getNodePathname()
        ));
        $action_name = $node_path->getMainNodeName();
        $logger->addDebug("DelineContainer", array(
            "procedure" => "handle",
            "action_name" => $action_name
        ));
        if (! $action_name) {
            return;
        }
        /** @var AbstractAction $action */
        $controller = ComponentCenter::getAction($this, $action_name);
        $logger->addDebug("DelineContainer", array(
            "procedure" => "handle",
            "action_availiable" => boolval($controller)
        ));
        if ($controller) {
            try {
                $logger->addInfo("DelineContainer", array(
                    "procedure" => "action",
                    "name" => $action_name,
                    "class" => get_class($controller),
                    "status" => "start"
                ));
                $controller->onControllerStart();
                $controller->onControllerHandle();
                $controller->onControllerEnd();
                $logger->addInfo("DelineContainer", array(
                    "procedure" => "action",
                    "name" => $action_name,
                    "class" => get_class($controller),
                    "status" => "end"
                ));
                return;
            } catch (PermissionDeniedException $exception) {
                $logger->addWarning("Action invoking failed!", array(
                    "error-src" => $exception->getFile()
                ));
                $this->dispatchPermissionDenied($exception->getMessage());
            } catch (\Exception $exception) {
                $logger->addWarning("Action invoking failed!", array(
                    "error-src" => $exception->getFile()
                ));
                $this->dispatchPageError($exception->getMessage());
            }
        } else {
            $logger->addWarning("Action invoking failed!", array(
                "message" => "Page Not Found"
            ));
            $this->dispatchPageNotFound();
        }
    }

    /**
     *
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
     *
     * @return Renderer
     */
    public function getRenderer()
    {
        if (is_null($this->renderer)) {
            $this->renderer = $componentCenter->getRenderer($this->getRendererType());
        }
        return $this->renderer;
    }

    /**
     *
     * @return SessionManager
     */
    public function getSession()
    {
        if (is_null($this->session)) {
            $this->session = new SessionManager();
        }
        return $this->session;
    }

    private function getAccessingType()
    {
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
     *
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
        global $logger;
        $this->getSession()->setUserInfoDAO(ComponentCenter::getDataAccessObject($this, "UserInfoDAO"));
        $this->getSession()->setRoleInfoDAO(ComponentCenter::getDataAccessObject($this, "RoleInfoDAO"));
        $logger->addDebug("DelineContainer", array(
            "node" => $this->getNodePathname()
        ));
    }

    /**
     *
     * @param string $message
     */
    public function dispatchPageError($message)
    {
        $this->dispatch("/System/PageError");
        $view = new RendererSetter($this->getRenderer());
        $view->setMessage("error", $message);
    }

    public function dispatchPageNotFound()
    {
        $this->dispatch("/System/PageNotFound");
    }

    public function dispatchPermissionDenied($message)
    {
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
                $this->dispatch("/Home");
            } else {
                $this->dispatch($this->getNodePathname());
            }
        } catch (NodePathFormatException $exception) {
            $logger->addError("Node Path Format Error", array(
                "node" => $this->getNodePathname()
            ));
            $this->dispatch("/System/NodePathError");
        }
    }

    /**
     * 销毁容器
     */
    public function destroy()
    {
        if (! $this->redirecting) {
            $this->getRenderer()->render();
        }
    }
}
