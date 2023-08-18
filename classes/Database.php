<?php

/**
 * Database
 *
 * A connection to the database
 */
class Database
{
    /**
     *
     * Get the database connection
     *
     * @return PDO object Connection to the database server
     */
    public function getConn() {
        $db_host = 'localhost';
        $db_user = 'csm_hora';
        $db_pass = '4DWp5Z_-a/Nb!OGA';
        $db_name = 'test';

        $dsn = 'mysql:host=' . $db_host . ';dbname=' .$db_name . ';charset=utf8';
        return $conn = new PDO($dsn,$db_user,$db_pass);
    }
}