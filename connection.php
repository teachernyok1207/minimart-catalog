<?php

function connection(){
    $server_name="localhost";
    $username="root";
    $password="";
    $db_name="minimart_catalog";

    // Creating new Connection
    $conn=new mysqli($server_name,$username,$password,$db_name);

    // Checking Connections
    if ($conn->connect_error){
        die("Connection Failed: ".$conn->connect_error);
    }else{
        return $conn;
    }
}

?>