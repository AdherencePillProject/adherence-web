<?php session_start(); 
?>
<?php

//$_SESSION['AccountID']=$_POST["accountID"];
//$_SESSION['AccountType']=$_POST["type"];;
//$_SESSION['Password']=$_POST["password"];
$_SESSION['accountID']=$_POST["accountID"];
$_SESSION['type']=$_POST["type"];;
$_SESSION['password']=$_POST["password"];


//THIS IS PROCESSSION OF LOGIN
$AccountID=$_POST["accountID"];
$AccountType=$_POST["type"];
$Password=$_POST["password"];



//GET THE VALID PASSWORD 
 $db = pg_connect("host=127.0.0.1 port=5432 dbname=postgres user=postgres password=root");
   //$db = pg_connect( "$host $port $dbname $credentials"  );
   if(!$db){
      echo "Error : Unable to open database\n";
   } else {
      echo "Opened database successfully\n";
   }


      /*-----user identify------9.16---*/
switch ($AccountType){
        case "Patient":
        $sql_password =<<<EOF
                            SELECT patient_password from patient where patient_id='$AccountID';
EOF;
          $password_query = pg_query($db, $sql_password);
          if(!$password_query){
             echo pg_last_error($db);
             exit;
          }  
          while( $password_row = pg_fetch_row($password_query)){
                 $curPassword=($password_row[0]);
          }
 
          
         break;

         case "Doctor":
         $sql_password =<<<EOF
                            SELECT doctor_password from octor where doctor_id='$AccountID';
EOF;
         $password_query = pg_query($db, $sql_password);
         if(!$password_query){
            echo pg_last_error($db);
            exit;
         }  
         while( $password_row = pg_fetch_row($password_query)){
                $curPassword=($password_row[0]);
         }
    
           
         
         break;
         case "Phamercy":
         break;  /**/
         default:
         $curPassword="";
} 

if ($curPassword==$Password){
    $response="valid";

   
}
else{
        $response="invalid";
}   

 echo $response;
 
?>