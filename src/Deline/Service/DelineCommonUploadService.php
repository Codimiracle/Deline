<?php
namespace Deline\Service;

use Deline\Utils\DelineUploadHandler;
use CommonUploadService;

class DelineCommonUploadService implements CommonUploadService
{

    /** @var DelineUploadHandler $uploader */
    private $uploader;

    private $options;

    public function __construct($dirname)
    {
        $this->options = array(
            "upload_dir" => getcwd() . "/static/" . $dirname
        );
    }

    public function doUpload()
    {
        $uploader = new DelineUploadHandler();
    }
}

