<?php
namespace Deline\Service;

use Deline\Component\Container;

class DelineUploadService implements UploadService
{

    private $container;

    private $infos;

    /**
     *
     * @return Container
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     *
     * @param Container $container
     */
    public function setContainer($container)
    {
        $this->container = $container;
    }

    public function getUploadInfo($field)
    {
        if (! isset($_FILES[$field])) {
            return null;
        }
        $raw = $_FILES[$field];
        if ($raw["name"] && !is_array($raw["name"])) { 
            return $raw;
        }
        return null;
    }

    public function getUploadInfoGroup($field)
    {
        $infos = array();
        if (! isset($_FILES[$field])) {
            return $infos;
        }
        $raw = $_FILES[$field];
        if (is_array($raw["name"])) {
            for ($i = 0; $i < count($raw["name"]); $i ++) {
                if (!$raw["name"][$i]) {
                    continue;
                }
                $info = array();
                $info["name"] = $raw["name"][$i];
                $info["size"] = $raw["size"][$i];
                $info["type"] = $raw["type"][$i];
                $info["tmp_name"] = $raw["tmp_name"][$i];
                $info["error"] = $raw["error"][$i];
                array_push($infos, $info);
            }
        } else {
            array_push($infos, $raw);
        }
        return $infos;
    }

    public function getFileExtension($filename)
    {
        $index = strripos($filename, ".");
        return substr($filename, $index + 1);
    }

    public function getUploadedFileExtension($field)
    {
        if (! is_array($_FILES[$field]["name"])) {
            return $this->getFileExtension($_FILES[$field]["name"]);
        } else {
            return "";
        }
    }

    public function delete($destination)
    {
        if (file_exists($destination)) {
            unlink($destination);
        }
    }

    /**
     * 获取安全文件名称
     *
     * @param string $extension
     * @return string
     */
    public function getSecurityFileName($extension)
    {
        return hash("md5", time() . rand() . rand()) . "." . $extension;
    }

    public function moveUploadedFileByInfo($info, $dir)
    {
        if ($info) {
            $target = $info["tmp_name"];
            $extension = $this->getFileExtension($info["name"]);
            $filename = $this->getSecurityFileName($extension);
            $destination = $dir . "/" . $filename;
            return move_uploaded_file($target, $destination) ? $filename : false;
        }
        return false;
    }

    public function moveUploadedFileByField($field, $dir)
    {
        $info = $this->getUploadInfo($field);
        return $this->moveUploadedFileByInfo($info, $dir);
    }

    private function isMimeTypeByMediatype($field, $mediatype)
    {
        if (is_array($_FILES[$field]["type"])) {
            foreach ($_FILES[$field]["type"] as $type) {
                if (stripos($type, $mediatype) != 0) {
                    return false;
                }
            }
            return true;
        } else {
            return stripos($_FILES[$field]["type"], $mediatype) == 0;
        }
    }

    public function isMimeType($field, $mimeType)
    {
        list ($mediatype, $subtype) = explode("/", $mimeType);
        if (!isset($_FILES[$field])) {
            return false;
        }
        if ($subtype == '*') {
            return $this->isMimeTypeByMediatype($field, $mediatype);
        } else {
            $raw = $_FILES[$field];
            if (is_array($raw["type"])) {
                foreach ($raw["type"] as $type) {
                    if ($type != $mimeType) {
                        return false;
                    }
                }
                return true;
            } else {
                return $raw["type"] == $mimeType;
            }
        }
    }
}

