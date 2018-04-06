<?php
namespace Deline\Model\DAO;

interface DataAccessObjectFactory
{

    /**
     *
     * @param string $name
     * @return DataAccessObject
     */
    public function getDataAccessObject($name);
}