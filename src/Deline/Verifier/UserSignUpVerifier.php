<?php
/**
 * Created by PhpStorm.
 * User: codimiracle
 * Date: 18-2-12
 * Time: 下午5:03
 */

namespace CAstore\Verifier;


class UserSignUpVerifier extends AbstractVerifier
{


    public function __construct()
    {
        if (!(isset($_POST["nickname"]) && $_POST["nickname"]))
            $_POST["nickname"] = $_POST["username"];
    }

    /**
     * @return array
     */
    public function getFields()
    {
        return array("username", "password", "gender", "nickname", "license");
    }

    public function getPattern($field)
    {
        switch ($field) {
            case "username":
                return "/^[A-Za-z0-9]{8,13}$/";
            case "password":
                return "/^[A-Za-z0-9\\$\\^!@#%&_-]{9,16}$/";
            case "gender":
                return "/^[0-2]$/";
            case "nickname":
                return "/^.{2,16}$/";
            case "license":
                return "/^on$/";
            default:
                return "/^$/";
        }
    }

    public function getPassedMessage($field)
    {
        return "验证正确";
    }

    public function getEmptyMessage($field)
    {
        switch ($field) {
            case "username":
                return "用户名不能为空！";
            case "password":
                return "密码不能为空！";
            case "gender":
                return "请选择性别！";
            case "license":
                return "你必须勾选\"我同意 《CAstore 服务协议》\"！";
            default:
                return "Unknow unrecognized message.";
        }
    }

    public function getUnrecognizedMessage($field)
    {
        switch ($field) {
            case "username":
                return "用户名只能由字母和数字组成，且长度在8到13个字符之间！";
            case "password":
                return "密码为字母和数字以及任何“!@#$%^&_-”特殊字符组成！";
            case "gender":
                return "性别只能是“保密”，“男生”，“女生”其中之一";
            case "nickname":
                return "昵称的长度为2到16个字符！";
            case "license":
                return "你必须同意 《CAstore 服务协议》！";
            default:
                return "Unknow unrecognized message.";
        }
    }
}