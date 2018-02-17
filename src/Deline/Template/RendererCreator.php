<?php
/**
 * Created by PhpStorm.
 * User: codimiracle
 * Date: 18-2-11
 * Time: 上午11:27
 */

namespace CAstore\Template;


class RendererCreator
{
    private static $mapping = array(
        "html" => HTMLRenderer::class,
        "json" => JSONRenderer::class,
        "resource" => ResourceRenderer::class
    );
    public static function getRenderer($type = "html") {
        if (isset(self::$mapping[$type])) {
            $renderer_class = self::$mapping[$type];
            return new $renderer_class;
        } else {
            return null;
        }
    }
}