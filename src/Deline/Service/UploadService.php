<?php
namespace Deline\Service;

interface UploadService extends Service
{

    public function isMimeType($field, $mimeType);
    public function moveUploadedFileByInfo($info, $dir);
    public function moveUploadedFileByField($field, $dir);
    public function delete($destination);
    public function getUploadInfo($field);
    public function getUploadInfoGroup($field);
    
}

