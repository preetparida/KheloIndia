<?php

class Retailer{
   
     public function retrive(){
        global $database;
            
       $sql = "SELECT * FROM `LOGIN` WHERE ID = '".$_SESSION['ID']."'";
       $result = $database->run_this_query($sql);
       return $result;
    }
    
    public function retrive_data($id){
        global $database;
        
        $sql = "SELECT * FROM LOGIN WHERE ID = '".$id."'";
        $result = $database->run_this_query($sql);
        $row = $result->fetch_object();
        return $row;
        
    }
    
    public function update($username,$password,$type,$id){
        global $database;
        
      $query = "UPDATE `LOGIN` SET `USER_NAME` = '".$username."', `PASSWORD` = '".$password."', `ROLE` = '".$type."' WHERE ID = '".$id."'";
      $result = $database->run_this_query($query); 
      if($result){
          return "Updated Successfully";
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

    public function fetch_report($fromDate, $toDate){
        global $database;
        $sql = "SELECT * FROM `report_tbl` WHERE UID = '".$_SESSION['ID']."' AND DRAWTIME BETWEEN '#".$fromDate."#' AND '#".$toDate."#'";
        $result = $database->run_this_query($sql);
        return $result;
    }
}

?>
