<?php
/**
 * Created by PhpStorm.
 * User: codimiracle
 * Date: 17-8-25
 * Time: 下午4:10
 */

namespace Test\Modules\Database;

use Modules\Database\DatabaseAccessor;

class DatabaseAccessorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DatabaseAccessor
     */
    private $accessor;
    public function setUP()
    {
        $this->accessor = new DatabaseAccessor();
    }

    public function testCreateTable()
    {
        $result = $this->accessor->query("CREATE TABLE test(id INTEGER PRIMARY KEY);");
        $this->assertTrue($result);
    }
}
