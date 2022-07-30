<?php
    include ('../config/connect.php');
    
    // Query to destroy the session
    session_destroy();
    
    // Redirect to Supplier Login page
    header("location: http://localhost/pc_parts_database_generator/user/supplier-login.php");
?>