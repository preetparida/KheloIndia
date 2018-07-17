<?php

class Superadmin{
    
    public $admin_username;
    public $admin_password;
    public $admin_type;

    public function insert(){
        
        global $database;
        
        $sql = "INSERT INTO LOGIN(USER_NAME,PASSWORD,ROLE) VALUES('".$this->admin_username."','".$this->admin_password."','".$this->admin_type."')";
        $result = $database->run_this_query($sql);
        
        if($result){
            return "Data Inserted Successfully";
        }
    }
    
    public function retrive_data(){
        
        global $database;
        $output = "";
        $sql = "SELECT * FROM LOGIN";
        $result = $database->run_this_query($sql);
         return $result;
    }
    public function retrive_data_form($id){
        
        global $database;
        $sql = "SELECT * FROM LOGIN WHERE ID = '".$id."'";
        $result = $database->run_this_query($sql);
        $row = $result->fetch_object();
         return $row;
    }
    
    public function update($admin_username,$admin_password,$admin_type,$id){
        global $database;
        
      $query = "UPDATE `LOGIN` SET `USER_NAME` = '".$admin_username."', `PASSWORD` = '".$admin_password."', `ROLE` = '".$admin_type."' WHERE ID = '".$id."'";
      $result = $database->run_this_query($query); 
      if($result){
          return "Updated Successfully";
      }
    }
    
    public function change_password($opwd,$npwd){
       global $database;
       
       $sql = "SELECT * FROM LOGIN WHERE PASSWORD = '".$opwd."' AND ID = '".$_SESSION['ID']."' AND ROLE = '".$_SESSION['ROLE']."'";
       $result = $database->run_this_query($sql);
       if($result->num_rows > 0){
           $query = "UPDATE LOGIN SET PASSWORD = '".$npwd."' WHERE ID = '".$_SESSION['ID']."' AND ROLE = '".$_SESSION['ROLE']."'";
           $pass_result = $database->run_this_query($query);
           if($pass_result){
               return "Password Changed Successfully";
           }
       }
       else{
           return "Password doesn't matched";
       }
    }
    
    public function delete($id){
        global $database;
        
        $sql = "DELETE FROM LOGIN WHERE ID = '".$id."'";
        $result = $database->run_this_query($sql);
        if($result){
            return true;
        }
        else{
            return false;
        }

    }

    
}

?>