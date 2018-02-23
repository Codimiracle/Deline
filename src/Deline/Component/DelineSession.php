<?php
namespace Deline\Component;

class DelineSession implements Session
{

    public function __construct()
    {
        if (session_id() == "") {
            session_start();
        }
    }

    public function setParameter($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function getParameter($key)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }
    
    public function getSessionData()
    {
        return $_SESSION;
    }

    public function destroy()
    {
        session_destroy();
    }

    public function restart()
    {
        if (session_id() != "") {
            session_destroy();
            session_start();
        }
    }
}

