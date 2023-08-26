<?php

/**
 * Authentification
 *
 * Login and logout
 */
class Auth {
    /**
     * Return the user authentification status
     * @return bool true if a user is logged in, false otehrwise
     */
    public static function isLoggedIn() {
        return isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'];
    }

    /**
     * Require the user to be logged in, stopping with unauthorised otherwise
     * @return void
     */
    public static function requireLogin() {
        if ( ! self::isLoggedIn()) {
            die("unauthorised");
        }
    }

    /**
     * Log in using the session
     * @return void
     */
    public static function login(){
        session_regenerate_id(true);

        $_SESSION['is_logged_in'] = true;
    }

    /**
     * Log out the user and destroy the cookies in this session
     * @return void
     */
    public static function logout(){
        $_SESSION=[];

        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();

            setcookie(
                session_name(),
                '',
                time()-42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }
    }
}