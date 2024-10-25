<?php

Class Security{
    public static function filterField($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public static function generateCSRF(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['token'] = md5(uniqid(mt_rand(), true));

    }

    public static function isValidToken($token){
        $token = self::filterField($token);

        if (!$token || $token !== $_SESSION['token']) {
            return false;
        }
        else{
            return true;
        }

    }

    public static function isRealDate($date) {
        if (false === strtotime($date)) {
            return false;
        }
        list($year, $month, $day) = explode('-', $date);
        return checkdate($month, $day, $year);
    }
}
