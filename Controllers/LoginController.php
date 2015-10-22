<?php session_start();
?>
<?php

//$_SESSION['AccountID']=$_POST["accountID"];
//$_SESSION['AccountType']=$_POST["type"];;
//$_SESSION['Password']=$_POST["password"];
$_SESSION['accountID'] = $_POST["account"];
$_SESSION['type'] = $_POST["Account_type"];
$_SESSION['password'] = $_POST["password"];


//THIS IS PROCESSSION OF LOGIN
$accountID = $_POST["account"];
$accountType = $_POST["Account_type"];
$password = $_POST["password"];

$sql_password_parameter = array($accountID);

//GET THE VALID PASSWORD 
$db = pg_connect("host=127.0.0.1 port=5432 dbname=postgres user=postgres password=root");
//$db = pg_connect( "$host $port $dbname $credentials"  );
if (!$db) {
    echo "cann't connect to database";
    return FALSE;
}

/* -----user identify------9.16--- */
switch ($accountType) {
    case "Patient":
        $sql_password = 'SELECT patient_password from patient where patient_id = $1';
        //echo $curPassword;
        break;
    case "Doctor":
        $sql_password = 'SELECT doctor_password from octor where doctor_id = $1';
        break;
    case "Phamercy":
        break;  /**/
    default:
        return FALSE;
}
$password_query = pg_query_params($db, $sql_password, $sql_password_parameter);
if (!$password_query) {
    echo pg_last_error();
    return FALSE;
}
//var_dump($password_query);
//var_dump($password_query);
$password_row = pg_fetch_row($password_query, 0);
//var_dump($password_row);
$curPassword = ($password_row[0]);

if ($curPassword == null) {
    echo "No password found";
    return FALSE;
}

pg_close($db);
//var_dump($password_query);
if ($curPassword == $password) {
    echo "valid";
    return "valid";
} else {
    echo "invalid";
    return "invalid";
}
?>