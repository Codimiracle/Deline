<?php
/**
 * Created by PhpStorm.
 * User: codimiracle
 * Date: 18-1-28
 * Time: 下午11:01
 */

namespace CAstore\Utils;


use CAstore\Component\DataSource;

class Voting
{
    const VOTE_UP_SENTENCE = "INSERT INTO vote(ccid, voted, uid) VALUES (:ccid, 1, :uid)";
    const VOTE_DOWN_SENTENCE = "INSERT INTO vote(ccid, voted, uid) VALUES (:ccid, -1, :uid)";
    const BALLOT_POSITIVE_SENTENCE = "SELECT count(id) FROM vote WHERE voted = 1";
    const BALLOT_NEGATIVE_SENTENCE = "SELECT count(id) FROM vote WHERE voted = -1";
    /**
     * @var DataSource
     */
    private $dataSource;

    /**
     * @return DataSource
     */
    public function getDataSource()
    {
        return $this->dataSource;
    }

    /**
     * @param DataSource $dataSource
     */
    public function setDataSource($dataSource)
    {
        $this->dataSource = $dataSource;
    }

    private function vote($content_id, $user_id, $positive = true) {
        $sentence = $positive ? self::VOTE_UP_SENTENCE : self::VOTE_DOWN_SENTENCE;
        try {
            $prepared = $this->dataSource->getConnection()->prepare($sentence);
            $prepared->bindParam(":ccid", $content_id);
            $prepared->bindParam(":uid", $user_id);
            $prepared->execute();
        } catch (\PDOException $exception) {
            throw new \Exception("操作过快！！");
        }
    }

    /**
     * @param $content_id
     * @param $user_id
     * @throws \Exception
     */
    public function voteUp($content_id, $user_id)
    {
        $this->vote($content_id, $user_id);
    }

    /**
     * @param $content_id
     * @param $user_id
     * @throws \Exception
     */
    public function voteDown($content_id, $user_id)
    {
        $this->vote($content_id, $user_id, false);
    }

    public function ballot($content_id, $positive = true)
    {
        $sentence = $positive ? self::BALLOT_POSITIVE_SENTENCE : self::BALLOT_NEGATIVE_SENTENCE;
        try {
            $prepared = $this->getDataSource()->getConnection()->prepare($sentence);
            $prepared->bindParam(":ccid", $content_id);
            $prepared->execute();
            return $prepared->fetchColumn(0);
        } catch (\PDOException $e) {
            return 0;
        }
    }
    /**
     * @param $content_id
     * @return int;
     */
    public function ballotPositive($content_id)
    {
        return $this->ballot($content_id);
    }

    public function ballotNegative($content_id)
    {
        return $this->ballot($content_id, false);
    }
}