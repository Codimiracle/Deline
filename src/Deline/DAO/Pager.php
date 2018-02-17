<?php
/**
 * Created by PhpStorm.
 * User: codimiracle
 * Date: 18-1-23
 * Time: 上午9:59
 */

namespace CAstore\DAO;


interface Pager
{
    /**
     * 获取转换后的 SQL 语句
     * @param $sentence string SQL 语句
     * @return string
     */
    public function getTranformSQL($sentence);

    /**
     * 跳过 offset 个页面
     * @return integer
     */
    public function getOffset();

    /**
     * 每页的数目
     * @return integer
     */
    public function getLength();

}