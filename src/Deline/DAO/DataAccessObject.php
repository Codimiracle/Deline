<?php
/**
 * Created by PhpStorm.
 * User: codimiracle
 * Date: 18-1-19
 * Time: 下午3:51
 */

namespace CAstore\DAO;

/**
 * Interface DataAccessObject
 * Abstract Document Pattern.
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

    public function insert();
    public function delete();
    public function update();

    public function query();
    public function queryById($id);

}