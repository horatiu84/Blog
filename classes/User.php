<?php

/**
 * A person or entity that can log in to the site
 */
class User {
    /**
     * Unique identifier
     * @var integer
     */
    public $id;
    /**
     * Unique username
     * @var string
     */
    public $username;
    /**
     * User's password
     * @var string
     */
    public $password;
    /**
     * Authenticate a user by username and password
     *
     * @param object $db -connection to the database
     * @param string $username Username
     * @param string $password Password
     *
     * @return bool true if the credentials are correct, null if not
     */
    public static function authenticate($db,$username,$password) {
       $sql = "SELECT *
               FROM users
               WHERE username = :username";

       $stmt =$db->prepare($sql);
       $stmt->bindValue(':username', $username, PDO::PARAM_STR);
       $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
       $stmt->execute();


       if ($user = $stmt->fetch()) {
           return $user->password == $password;
       }
    }
}