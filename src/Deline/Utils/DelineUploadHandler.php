<?php
namespace Deline\Utils;

use Deline\Model\Entity\FileInfo;
use Deline\Service\DelineUploadService;
use Deline\Service\FileService;

class DelineUploadHandler
{
    private $options;
    private $field;
    private $group;
    private $contentId;
    
    /** @var DelineUploadService */
    private $uploadService;
    private $fileService;
    
    public function __construct($field, $contentId, $options = null, $group = false) {
        $this->field = $field;
        $this->contentId = $contentId;
        $this->options = array(
            "upload_dir" => getcwd()."/static/files"
        );
        if (is_array($options)) {
            $this->options = $options +  $this->options;
        }
    }
    
    
    
    /**
     * @return DelineUploadService
     */
    public function getUploadService()
    {
        return $this->uploadService;
    }

    /**
     * @param DelineUploadService $uploadService
     */
    public function setUploadService($uploadService)
    {
        $this->uploadService = $uploadService;
    }
    
    
    
    /**
     * @return FileService
     */
    public function getFileService()
    {
        return $this->fileService;
    }

    /**
     * @param FileService $fileService
     */
    public function setFileService($fileService)
    {
        $this->fileService = $fileService;
    }

    private function move($contentId, $field, $dir) {
        $name = $this->uploadService->moveUploadedFileByInfo($info, $dir);
        $fileInfo = new FileInfo();
        $fileInfo->setMimeType($info["type"]);
        $fileInfo->setPath($dir . "/" . $name);
        $fileInfo->setSize($info["size"]);
        $fileInfo->setField($field);
        $fileInfo->setTargetId($contentId);
        $this->fileService->append($fileInfo);
    }
    public function handle() {
        if ($this->group) {
            $info = $this->uploadService->getUploadInfo($this->field);
            //上传成功！
            if ($info != null && $info["error"] == 0) {
                $this->move($this->contentId, $this->field, $this->options["upload_dir"]);
                return true;
            }
        } else {
            $success = true;
            $infos = $this->uploadService->getUploadInfoGroup($this->field);
            foreach ($infos as $info) {
                if ($info != null && $info["error"] == 0) {
                    $this->move($this->contentId, $this->field, $this->options["upload_dir"]);
                } else {
                    $success = false;
                }
            }
            return $success;
        }
        return false;
    }
}

