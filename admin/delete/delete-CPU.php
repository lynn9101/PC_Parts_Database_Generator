<?php
    include('C:\xampp\htdocs\pc_parts_database_generator\config\connect.php');
    // Get the CPU ID to be deleted
    echo $cpuid = $_GET['id'];
    
    // Create SQL Query
    $sql = "DELETE FROM Cpu WHERE partid=$cpuid";
    $conn = OpenCon();
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    // Redirect back to the suppliers-list.php after deletion
    if ($result == TRUE) {
        $_SESSION['delete'] = "CPU Deleted Successfully";

        // Redirect to previous page
        header("location: http://localhost/pc_parts_database_generator/admin/manage-CPU.php");

    } else {
        $_SESSION['delete'] = "Failed to Delete CPU";

        // Redirect to previous page
        header("location: http://localhost/pc_parts_database_generator/admin/manage-CPU.php");
    }
?>