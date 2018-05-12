<?php
namespace Deline\Model\DAO;


interface FileInfoDAO extends DataAccessObject
{

    public function queryByTargetId($targetId);
}

