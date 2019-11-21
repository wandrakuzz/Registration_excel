<?php

if (! function_exists('getGuardName')) {
    /**
     * Set invalid form when there is error occured
     *
     * @param string $errors
     * @param string $name
     * @return mixed
     */
    function getGuardName()
    {
        if (Auth::guard('admin-web')->check()) {
            return "admin-web";
        } elseif (Auth::guard('web')->check()) {
            return "web";
        }
    }
}
