<?php
/**
 * Created by PhpStorm.
 * User: codimiracle
 * Date: 18-1-23
 * Time: 上午10:01
 */

namespace CAstore\DAO;


class SimplePager implements Pager
{
    const LIMIT_CAUSE = " LIMIT ?,?";

    private $offset;
    private $length;

    public function getOffset()
    {
        return $this->offset;
    }

    public function getLength()
    {
        return $this->length;
    }

    public function getTranformSQL($sentence)
    {
        return $sentence.self::LIMIT_CAUSE;
    }
}