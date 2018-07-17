<?php
require_once("database.php");

class Users{

public static function verify_user($username,$password){

        global $database;

        $username = $database->escape_string($username);
        $password = $database->escape_string($password);

        $sql = "SELECT * FROM LOGIN WHERE USER_NAME = '$username' AND PASSWORD = '$password'";
        $result = $database->run_this_query($sql);

        if($result->num_rows > 0){

            return $result->fetch_object();

        }
        else {

            return false;

    
        }
    }


}


?>
