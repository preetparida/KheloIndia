<?php

require_once ("config.php");


class Database {

    public $connection;

    function __construct()
    {

        $this->open_db_connection();

    }

    public function open_db_connection() {

        $this->connection = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

        if($this->connection->connect_error) {

            die("connection failed" . $this->connection->connect_error);

        }


    }



    public function run_this_query($sql) {

        $result_set = $this->connection->query($sql);

        if(!$result_set) {

            die("query failed" . $this->connection->error);

        }

        else {
            return $result_set;

        }

    }

    public function the_insert_id() {

        return mysqli_insert_id($this->connection);

    }

    public function escape_string($string) {

        $data = trim($string);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $escaped_string = $this->connection->real_escape_string($data);
        return $escaped_string;

    }


}

$database = new Database();


?>
