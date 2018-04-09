<?php

require_once('db_credentials.php');
// connect to database
function db_connect(){
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    confirm_db_connect();
    return $connection;
}
// disconnect to database
function db_disconnect($connection){
    if(isset($connection)){
        mysqli_close($connection);
    }
}
// error handling for connection to database
function confirm_db_connect() {
    if(mysqli_connect_errno()) {
        $msg = "Database connection failed";
        $msg .= mysqli_connect_error();
        $msg .= "(" . mysqli_connect_errno . ")";
        exit($msg);
    }
}
// error handling for sql query result
function confirm_result_set($result_set) {
    if(!$result_set) {
        exit("Database Query Failed!");
    }
}

function db_escape($connection, $string) {
    return mysqli_real_escape_string($connection, $string);
}