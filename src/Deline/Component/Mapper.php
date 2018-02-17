<?php
/**
 * Created by PhpStorm.
 * User: codimiracle
 * Date: 18-1-17
 * Time: 下午8:37
 */

namespace CAstore\Component;


class Mapper
{
    private $map = array();

    /**
     * 获取第一个匹配 $actual 的 value.
     * @param string $actual
     * @return mixed|null
     */
    public function match($actual) {
        foreach (array_keys($this->map) as $pattern) {
            $isMatched = preg_match($pattern, strval($actual));
            if ($isMatched) {
                return $this->map[$pattern];
            }
        }
        return null;
    }

    /**
     * 映射
     * @param $pattern
     * @param $something
     */
    public function map($pattern, $something) {
        $this->map[$pattern] = $something;
    }
}