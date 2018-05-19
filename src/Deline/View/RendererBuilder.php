<?php
namespace Deline\View;

class RendererBuilder
{

    const MESSAGE_ICON_INFO = "info";
    
    const MESSAGE_ICON_WARNING = "warning";

    const MESSAGE_ICON_DANGER = "danger";

    /**
     *
     * @var Renderer
     */
    private $renderer;

    public function __construct($renderer)
    {
        $this->renderer = $renderer;
    }

    public function setPageTitle($title)
    {
        $this->renderer->setAttribute("title", $title);
        return $this;
    }

    public function setPageName($name)
    {
        $this->renderer->setAttribute("page-name", $name);
    }

    public function setData($key, $value)
    {
        $this->renderer->setParameter("code", 200);
        $data = $this->renderer->getParameter("data");
        $data = is_null($data) ? array() : $data;
        $this->renderer->setParameter("data", $data + array($key => $value));
    }

    public function setMessage($icon, $message)
    {
        $this->renderer->setParameter("code", 500);
        $this->renderer->setParameter("data", array(
            "type" => "msg",
            "icon" => $icon,
            "message" => $message
        ));
        return $this;
    }
}