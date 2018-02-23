<?php
namespace Deline\Component;

interface Session
{
    /**
     * 设置会话参数
     *
     * @param string $key
     * @param mixed $value
     */
    public function setParameter($key, $value);
    
    /**
     * 获取会话参数
     *
     * @param string
     *            $key
     * @return mixed|null
     */
    public function getParameter($key);
    
    /**
     * 获取会话数据
     * @return array
     */
    public function getSessionData();
    
    public function restart();
    public function destroy();
}

