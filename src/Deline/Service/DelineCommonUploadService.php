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
        $uploader = new DelineUploadHandler($dirname);
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

