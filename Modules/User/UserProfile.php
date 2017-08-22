<?php
/**
 * Created by PhpStorm.
 * User: codimiracle
 * Date: 17-8-18
 * Time: 下午11:06
 */

namespace Modules\User;


use Modules\Database\Entity;

class UserProfile extends Entity
{
    protected function __construct(\mysqli_result $result)
    {
        parent::__construct($result);
    }

    public function getName() {

    }

    public function getPassword() {

    }
    public function setGender() {

    }
    public function getGender() {

    }

    /**
     * @param string $tags
     */
    public function setTags($tags) {

    }

    public function getTags() {

    }
}