<?php
namespace Deline\Model\DAO;

/**
 * Interface DataAccessObject
 * Abstract Document Pattern.
 *
 * @package Core\Utils
 */
interface DataAccessObject
{

    public function setTarget($target);

    public function getTarget();

    public function setDataSource($databaseAccessor);

    public function getDataSource();

    public function setPager($pager);

    public function getPager();
    
    public function getLastInsertedId();

    public function insert();

    public function delete();

    public function update();

    public function query();

    public function queryById($id);
}