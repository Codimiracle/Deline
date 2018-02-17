<?php
/**
 * Created by PhpStorm.
 * User: codimiracle
 * Date: 18-1-23
 * Time: 下午10:36
 */

namespace CAstore\DAO;


use CAstore\Entity\UserInfo;

class IUserInfoDAO extends AbstractDAO implements UserInfoDAO
{
    const INSERT_CONTENT = "INSERT INTO content(title, name, content) VALUES (:nickname, 'userdata', :description)";
    const INSERT_USER = "INSERT INTO user(cid, name, password, gender, rid) VALUES (:cid, :name, :password, :gender, :rid)";
    const DELETE_CONTENT = "DELETE FROM content WHERE id = (SELECT cid FROM user WHERE id = :id)";
    const DELETE_USER = "DELETE FROM user WHERE id = :id";
    const UPDATE_CONTENT = "UPDATE content SET title = :nickname, content = :description WHERE id = (SELECT cid FROM user WHERE id = :id)";
    const UPDATE_USER = "UPDATE user SET name = :name, password = :password, gender = :gender, rid = :rid WHERE id = :id";

    const QUERY = "SELECT * FROM user_info";
    const QUERY_BY_ID = self::QUERY." WHERE id = :id";
    const QUERY_BY_TAG = self::QUERY." WHERE EXISTS (SELECT 1 FROM tag, user WHERE tag.cid = user.cid AND user.id = user_info.id AND tag.name LIKE concat('%',replace(:tag, ' ', '%'), '%'))";
    const QUERY_BY_NAME = self::QUERY." WHERE name = :name";

    /**
     * @return UserInfo
     */
    public function getTarget()
    {
        return parent::getTarget();
    }


    public function insert()
    {
        $connection = $this->getDataSource()->getConnection();
        try {
            $connection->beginTransaction();
            $prepared = $connection->prepare(self::INSERT_CONTENT);
            $prepared->bindValue(":nickname", $this->getTarget()->getNickname());
            $prepared->bindValue(":description", $this->getTarget()->getDescription());
            $prepared->execute();
            $inserted_id = $connection->lastInsertId("id");
            $prepared = $connection->prepare(self::INSERT_USER);
            $prepared->bindValue(":cid", $inserted_id);
            $prepared->bindValue(":name", $this->getTarget()->getName());
            $prepared->bindValue(":password", $this->getTarget()->getPassword());
            $prepared->bindValue(":gender", $this->getTarget()->getGender());
            $prepared->bindValue(":rid", $this->getTarget()->getRoleId());
            $prepared->execute();
            $connection->commit();
        } catch (\PDOException $e) {
            $connection->rollBack();
            throw $e;
        }
    }

    public function delete()
    {
        $connection = $this->getDataSource()->getConnection();
        try {
            $connection->beginTransaction();
            foreach (array(self::DELETE_CONTENT, self::DELETE_USER) as $sentence) {
                $prepared = $connection->prepare($sentence);
                $prepared->bindValue(":id",$this->getTarget()->getId());
                $prepared->execute();
            }
            $connection->commit();
        } catch (\PDOException $e) {
            $connection->rollBack();
            throw  $e;
        }
    }

    public function update()
    {
        $connection = $this->getDataSource()->getConnection();
        try {
            $connection->beginTransaction();
            $prepared = $connection->prepare(self::UPDATE_CONTENT);
            $prepared->bindValue(":nickname", $this->getTarget()->getNickname());
            $prepared->bindValue(":description", $this->getTarget()->getDescription());
            $prepared->bindValue(":id", $this->getTarget()->getId());
            $prepared->execute();
            $prepared = $connection->prepare(self::UPDATE_USER);
            $prepared->bindValue(":name", $this->getTarget()->getName());
            $prepared->bindValue(":password", $this->getTarget()->getPassword());
            $prepared->bindValue(":gender", $this->getTarget()->getGender());
            $prepared->bindValue(":rid", $this->getTarget()->getRoleId());
            $prepared->bindValue(":id", $this->getTarget()->getId());
            $prepared->execute();
            $connection->commit();
        } catch (\PDOException $e) {
            $connection->rollBack();
            throw $e;
        }
    }

    public function query()
    {
        return $this->getEntities(self::QUERY, array(), UserInfo::class);
    }

    public function queryById($id)
    {
        return $this->getEntity(self::QUERY_BY_ID, array(":id" => $id), UserInfo::class);
    }

    public function queryByName($name)
    {
        return $this->getEntity(self::QUERY_BY_NAME, array(":name" => $name), UserInfo::class);
    }

    public function queryByTag($tag)
    {
        return $this->getEntities(self::QUERY_BY_TAG, array(":tag" => $tag), UserInfo::class);
    }

    public function queryByRoleId()
    {
        // TODO: Implement queryByRoleId() method.
    }
}