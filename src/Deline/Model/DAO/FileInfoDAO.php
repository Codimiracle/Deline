<?php
namespace CAstore\Model\DAO;

use Deline\Model\DAO\DataAccessObject;

interface FileInfoDAO extends DataAccessObject
{

    public function queryByTargetId($targetId);
}

