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
        $this->renderer->setParameter($key, $value);
    }

    public function setMessage($icon, $message)
    {
        $this->renderer->setParameter("type", "msg");
        $this->renderer->setParameter("icon", $icon);
        $this->renderer->setParameter("message", $message);
    }
}