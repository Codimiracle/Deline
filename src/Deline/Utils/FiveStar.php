<?php
/**
 * Created by PhpStorm.
 * User: codimiracle
 * Date: 18-1-28
 * Time: 下午11:08
 */

namespace CAstore\Utils;


use CAstore\Component\DataSource;
use PHPUnit\Runner\Exception;

class FiveStar
{
    const MARK_STARTS = "INSERT INTO mark (ccid, stars, uid) VALUES (:ccid, :stars, :uid)";
    const STATS_BY_CONTENT_ID = "SELECT avg(stars) FROM mark WHERE ccid = :ccid";
    const STATS_BY_CONTENT_ID_AND_USER_ID = "SELECT stars FROM mark WHERE ccid = :ccid AND uid = :uid";

    /**
     * @var DataSource
     */
    private $dataSource;

    /**
     * @return mixed
     */
    public function getDataSource()
    {
        return $this->dataSource;
    }

    /**
     * @param DataSource $data_source
     */
    public function setDataSource($data_source)
    {
        $this->dataSource = $data_source;
    }

    /**
     * @param $content_id
     * @param $stars
     * @param $user_id
     * @throws \Exception
     */
    public function mark($content_id,$user_id, $stars) {
        try {
            $prepared = $this->dataSource->getConnection()->prepare(self::MARK_STARTS);
            $prepared->bindParam(":ccid", $content_id);
            $prepared->bindParam(":stars", $stars);
            $prepared->bindParam(":uid", $user_id);
            $prepared->execute();
        } catch (\PDOException $e) {
            throw $e;
            throw new \Exception("操作过快!");
        }
    }

    /**
     * @param int $content_id
     * @param int $userId
     * @return int|float;
     */
    public function stars($content_id, $userId = null) {
        $sentence = $userId ? self::STATS_BY_CONTENT_ID_AND_USER_ID : self::STATS_BY_CONTENT_ID;
        try {
            $prepared = $this->dataSource->getConnection()->prepare($sentence);
            $prepared->bindParam(":ccid", $content_id);
            if ($userId) {
                $prepared->bindParam(":uid", $content_id);
            }
            $prepared->execute();
            return $prepared->fetchColumn(0);
        } catch (\PDOException $e) {
            throw $e;
            throw new Exception("拉取数据失败");
        }
    }
}