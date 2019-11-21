<?php

/**
 *
 */
class GuardName
{
    public function getGuardName()
    {
        if (Auth::guard('admin-web')->check()) {
            return "admin-web";
        } elseif (Auth::guard('user')->check()) {
            return "user";
        }
    }
}
