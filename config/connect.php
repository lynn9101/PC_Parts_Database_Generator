<?php
    function OpenCon()
    {
        //session_start();
        $home_page_url = "http://localhost/pc_parts_database_generator/";

        $dbhost = "localhost";
        $dbuser = "root";
        $dbpass = "root";
        $db = "pc_components_tracker";

        $conn = new mysqli($dbhost, $dbuser, 
        $dbpass,$db) or die("Connect failed: %s\n". 
        $conn -> error);
        return $conn;
    }

    function CloseCon($conn)
    {
        $conn -> close();
    }
?>