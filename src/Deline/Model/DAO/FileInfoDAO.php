<?php
namespace Deline\Model\DAO;


interface FileInfoDAO extends DataAccessObject
{

    public function queryByTargetId($targetId);
    public function queryByTargetIdWithField($targetId, $field);
}

