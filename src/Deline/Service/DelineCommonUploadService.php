<?php
namespace Deline\Service;

use Deline\Utils\DelineCommonUploadHandler;
use CommonUploadService;

class DelineCommonUploadService implements CommonUploadService
{

    /** @var DelineCommonUploadHandler $uploader */
    private $uploader;
    
    private $container;

    public function doUpload($dirname = null)
    {
        $uploader = new DelineCommonUploadHandler($dirname);
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

