<?php
/**
 * Created by PhpStorm.
 * User: codimiracle
 * Date: 18-1-19
 * Time: 下午4:18
 */

namespace CAstore\Template;

class JSONRenderer implements Renderer
{
    const RENDERER_VERSION = 0;
    const RESULT_TYPE_DATA = "data";
    const RESULT_TYPE_ERROR = "error";

    private $attributes = array();
    private $json = array("version" => self::RENDERER_VERSION, "result" => array());

    public function setParameter($key, $value)
    {
        $this->json["result"][$key] = $value;
    }

    public function getParameter($key)
    {
        return $this->json["result"][$key];
    }

    public function render()
    {
        header("Content-Type: text/json");
        echo json_encode($this->json);
    }

    public function setAttribute($attribute_name, $attribute_value)
    {
        $this->attributes[$attribute_name] = $attribute_value;
    }

    public function getAttribute($attribute_name)
    {
        return $this->attributes[$attribute_name];
    }
}