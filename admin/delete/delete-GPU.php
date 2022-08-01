<?php
    include('C:\xampp\htdocs\pc_parts_database_generator\config\connect.php');
    // Get the Supplier ID to be deleted
    echo $gpuid = $_GET['id'];
    echo $model = $_GET['model'];

    // Create SQL Query
    $sql = "DELETE FROM GPU_Contains1 WHERE gpuid=$gpuid AND model='$model'";
    $conn = OpenCon();
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    // Redirect back to the suppliers-list.php after deletion
    if ($result == TRUE) {
        $_SESSION['delete'] = "GPU Added Successfully";

        // Redirect to previous page
        header("location: http://localhost/pc_parts_database_generator/admin/manage-GPU.php");

    } else {
        $_SESSION['delete'] = "Failed to Delete GPU";

        // Redirect to previous page
        header("location: http://localhost/pc_parts_database_generator/admin/manage-GPU.php");
    }
    
?>