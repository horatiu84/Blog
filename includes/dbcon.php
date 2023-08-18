<?php

/**
 * Get the database connection
 * 
 * @return object Connection to a MySQL server
 */

function dbConnect() {

    $db_host = 'localhost';
    $db_user = 'csm_hora';
    $db_pass = '4DWp5Z_-a/Nb!OGA';
    $db_name = 'test';
    
    $db = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
    
    if(mysqli_connect_error()) {
        echo mysqli_connect_error();
        exit;
    };

    return $db;
}



