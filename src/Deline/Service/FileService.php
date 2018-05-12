<?php
namespace CAstore\Service;

use Deline\Service\EntityService;

interface FileService extends EntityService
{
    public function queryByTargetId($targetId);
    
    public function query();
}

