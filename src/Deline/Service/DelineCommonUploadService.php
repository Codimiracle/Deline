<?php
namespace Deline\Service;

use Deline\Utils\DelineUploadHandler;
use CommonUploadService;

class DelineCommonUploadService implements CommonUploadService
{

    /** @var DelineUploadHandler $uploader */
    private $uploader;

    public function doUpload($dirname = null)
    {
        $path = getcwd() . "/static/";
        if ($dirname) {
            $path .= $dirname;
        } else {
            $path .= "files";
        }
        $uploader = new DelineUploadHandler(array(
            "upload_dir" => $path
        ));
    }
}

