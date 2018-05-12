<?php
namespace Deline\Service;

interface FileService extends EntityService
{
    public function queryByTargetId($targetId);
    public function queryByTargetIdWithField($targetId, $field);
    public function query();
}

