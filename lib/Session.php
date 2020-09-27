<?php

use App\Models\User;

class Session
{
    public function __construct()
    {
        if(!isset($_SESSION) && env('APP_ENV') != 'development') {
            session_start();
        }

        if (isset($_SESSION['start_session'])) {
            $duration = time() - (int)$this->get('start_session');
            if ($duration > env('SESSION_LIFETIME', 3600)) {
                $this->end();
            } else {
                $this->set('start_session', time());
            }
        }
    }

    public function check()
    {
        if (isset($_SESSION['user'])) {
            return true;
        }

        return false;
    }

    public function start(User $user)
    {
        unset($user->password);
        $this->set('user', $user);
        $this->set('start_session', time());
    }

    public function end()
    {
        if(!isset($_SESSION)) {
            session_destroy();
        }
    }

    public function all()
    {
        return $_SESSION;
    }

    public function get($key)
    {
        return $_SESSION[$key] ?? null;
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }
}
