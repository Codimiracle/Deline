<?php
/**
 * Created by PhpStorm.
 * Component: codimiracle
 * Date: 18-1-17
 * Time: 下午3:42
 */
namespace Deline\Component;

class Security
{
    public static function escapeHTML($input) {
        return htmlspecialchars($input);
    }

    public static function escapeSQL($input) {

    }

    public static function password($input) {
        return hash("sha256", $input);
    }

}