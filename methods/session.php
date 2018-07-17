<?php

class Session {

    private $signed_in = true;
    public  $ID;
    public  $ROLE;
  

    function __construct() {
        session_start();
        $this->check_the_login();
       // $this->check_message();
    }

    public function is_signed_in () {

        return $this->signed_in;

    }

    public function login ($user) {

        if($user) {

            $this->ID = $_SESSION['ID'] = $user->ID;
            $this->ROLE = $_SESSION['ROLE'] = $user->ROLE;
            $this->signed_in = true;

        }

    }


    public function logout () {

        unset($_SESSION['ID']);
        unset($_SESSION['ROLE']);
        unset($this->ID);
        unset($this->ROLE);
        $this->signed_in = false;

    }

    private function check_the_login () {

        if(isset($_SESSION['ID']) && isset($_SESSION['ROLE'])) {

            $this->ID = $_SESSION['ID'];
            $this->ROLE = $_SESSION['ROLE'];
            $this->signed_in = true;

        }
        else {
			unset($_SESSION['ID']);
			unset($_SESSION['ROLE']);
            unset($this->ID);
            unset($this->ROLE);
            $this->signed_in = false;

        }

    }


}



$session = new Session();
//$the_message_to_display = $session->message();




?>