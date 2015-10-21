<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SignUpController
 *
 * @author mengchaowang
 */
if (isset($_POST['submit'])) {
    $info = array($_POST["name"], $_POST["ID"], $_POST["password"], $_POST["phone"], $_POST["email"], $_POST["address"]);

    $con = pg_connect("host=127.0.0.1 port=5432 dbname=postgres user=postgres password=root");
    if (!$con) {
        echo "Failed to connect to database";
    }
// We need to find a way to hash the password instead of storing plaintext
    $query = 'INSERT INTO patient(patient_id, patient_name, phone_number, e_mail, address, patient_password) '
            . 'VALUES($1, $2, $3, $4, $5, $6);';
    $result = pg_query_params($con, $query, $info);

    var_dump($result);
    if (!$result) {
        echo "FALSE";
    }
    pg_close($con);

    header('Location: /SmartCapWeb-V2.0/View/login.php');
}

