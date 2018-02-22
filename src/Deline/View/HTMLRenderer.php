<?php
namespace Deline\View;

class HTMLRenderer implements Renderer
{

    const HEADER = "header";

    const FOOTER = "footer";

    private $parameters = array();

    private $attributes = null;

    public function __construct()
    {
        global $website;
        $this->attributes = $website;
    }

    // 设置 Renderer Variable.
    public function setParameter($key, $value)
    {
        $this->parameters[$key] = $value;
    }

    // 获取 Renderer Variable.
    public function getParameter($key)
    {
        if (isset($this->parameters[$key])) {
            return $this->parameters[$key];
        } else {
            return null;
        }
    }

    // 加载 HTML 模板
    private function load($page_name)
    {
        $template_file = getcwd() . "/templates/tpl." . $page_name . ".php";
        if (file_exists($template_file)) {
            $attributes = $this->attributes;
            $parameters = $this->parameters;
            require $template_file;
        }
    }

    public function render()
    {
        $this->load(self::HEADER);
        $this->load($this->getAttribute("page-name"));
        $this->load(self::FOOTER);
    }

    public function setAttribute($attribute_name, $attribute_value)
    {
        $this->attributes[$attribute_name] = $attribute_value;
    }

    public function getAttribute($attribute_name)
    {
        if (isset($this->attributes[$attribute_name])) {
            return $this->attributes[$attribute_name];
        } else {
            return null;
        }
    }
}