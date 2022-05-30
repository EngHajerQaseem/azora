<?php
include("connect2.php");
session_start();
$userId=$_SESSION["id"] ;
if(!empty($_POST))  
 {  
     if(isset($_POST["full"])){
      //  $userId =  $_POST["userId"];
      $name =trim($_POST["full"]);  
   
        $update="UPDATE users SET full_name='".$name."' where id='".$userId."'";

        $stmt = $mysqli->prepare($update);
    
    
        $stmt->execute();
    
    
        $stmt->close();
    
        // Close connection
        mysqli_close($mysqli);
   
      echo $name;  

     }
     elseif(isset($_POST["phone"])){
      $phone =  $_POST["phone"];  

      $sql = "SELECT  phone FROM users WHERE id ='".$userId."'";

      if($stmt = mysqli_prepare($mysqli, $sql)){
            
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
          // Store result
          mysqli_stmt_store_result($stmt);
                  
          // Check if info exists, if yes then verify password
          if(mysqli_stmt_num_rows($stmt) > 0){  
  
            // Bind result variables
            mysqli_stmt_bind_result($stmt, $phoneNumber);
  
            if(mysqli_stmt_fetch($stmt)){              
              if ($phoneNumber===$phone) {
                
                echo "This phone is already taken.";
                mysqli_stmt_close($stmt);
 
                mysqli_close($mysqli); 
              } 
              else{
                $update="UPDATE users SET phone='".$phone."' where id='".$userId."'";
        
                $stmt = $mysqli->prepare($update);
            
            
                $stmt->execute();
            
            
                $stmt->close();
            
                // Close connection
                mysqli_close($mysqli);
           
              echo $phone;  
              }
             
          } 
          
      }

   }
 
  
} 

      


       
   
        


     }

     elseif(isset($_POST["newpass"])){
       // $userId =  $_POST["userId"];
        $newpass =  $_POST["newpass"]; 
       // $hasedpass=password_hash($newpass, PASSWORD_DEFAULT); 

        $salt = sha1(md5($newpass));
        $pass=md5($newpass.$salt);
   
        $update="UPDATE users SET password='".$pass."' where id='".$userId."'";

        $stmt = $mysqli->prepare($update);
    
    
        $stmt->execute();
    
    
        $stmt->close();
    
        // Close connection
        mysqli_close($mysqli);
   
     


     }

     elseif(isset($_POST["current_pass"])){
       // $userId =  $_POST["userId"];
        $current_pass =  $_POST["current_pass"]; 
        //$hasedpass=password_hash($current_pass, PASSWORD_DEFAULT); 
        $salt = sha1(md5($current_pass));
        $pass=md5($current_pass.$salt);
   
        $sql = "SELECT  password FROM users WHERE id ='".$userId."'";

        if($stmt = mysqli_prepare($mysqli, $sql)){
              
          // Attempt to execute the prepared statement
          if(mysqli_stmt_execute($stmt)){
            // Store result
            mysqli_stmt_store_result($stmt);
                    
            // Check if info exists, if yes then verify password
            if(mysqli_stmt_num_rows($stmt) > 0){  
    
              // Bind result variables
              mysqli_stmt_bind_result($stmt, $passwordEnc);
    
              if(mysqli_stmt_fetch($stmt)){              
                if ($pass!=$passwordEnc) {
                  
                  echo "The Password is not correct ";
    
                } 
               
            } 
            
        }

     }
   
     
  } 
}
 }

 ?>