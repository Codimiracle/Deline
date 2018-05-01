<?php
namespace Deline\Service;

use Deline\Utils\DelineUploadHandler;
use CommonUploadService;

class DelineCommonUploadService implements CommonUploadService
{

    /** @var DelineUploadHandler $uploader */
    private $uploader;
    
    private $container;

    public function doUpload($dirname = null)
    {
        $path = getcwd() . "/static/";
        if ($dirname) {
            $path .= $dirname;
        } else {
            $path .= "uploads";
        }
        $uploader = new DelineUploadHandler(array(
            "upload_dir" => $path
        ));
    }
    public function getContainer()
    {
        return $this->container;
    }

    public function setContainer($container)
    {
        $this->container = $container;
    }

}

