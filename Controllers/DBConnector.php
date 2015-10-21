<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DBConnector
 *
 * @author mengchaowang
 */
class DBConnector {
    private static $dbConnection;
    public static function openDBConnection(){
         $this->dbConnection = pg_connect("host=127.0.0.1 port=5432 dbname=postgres user=postgres password=root");
         if(!$this->dbConnection ){
             return FALSE;
         } else {
             return TRUE;
         }
    }
    
    public static function executeQuery($query, $parameters){
        // To prevent from SQL Injection, use parameterization.
        $result = openDBConnection();
        if($result){
            // DB Connection is open, execute the query
            $result = pg_query_params($this->dbConnection, $query, $parameters);
            // Closing connection
            pg_close($this->dbConnection);
        }else{
            return FALSE;
        }
    }
}
