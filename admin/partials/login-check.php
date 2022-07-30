<?php
    // Check whether user is login or not
    // Authorization: Access Control
    if (!isset($_SESSION['supplier'])) {    // If Login is failed
        // Redirect to login page with message
        $_SESSION['login-fail'] = "Error in Login. Please login to access supplier panel.";
        
        header("location: http://localhost/pc_parts_database_generator/user/supplier-login.php");
    }
?>