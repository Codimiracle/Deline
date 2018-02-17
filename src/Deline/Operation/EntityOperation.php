<?php
/**
 * Created by PhpStorm.
 * User: codimiracle
 * Date: 18-2-14
 * Time: 下午2:38
 */

namespace CAstore\Operation;


interface EntityOperation extends Operation
{
    public function setTarget($entity);
    public function getTarget($entity);
    public function append();
    public function delete();
    public function edit();
    public function update();
    public function queryById($id);
}