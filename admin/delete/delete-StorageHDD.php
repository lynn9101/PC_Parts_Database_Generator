<?php
    include('C:\xampp\htdocs\pc_parts_database_generator\config\connect.php');
    // Get the GPU ID to be deleted
    echo $model = $_GET['model'];
    echo $storagesize = $_GET['size'];

    // Create SQL Query
    $sql = "DELETE FROM HDDStorage3 WHERE model='$model' AND storagesizeGB=$storagesize";
    $conn = OpenCon();
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    // Redirect back to the suppliers-list.php after deletion
    if ($result == TRUE) {
        $_SESSION['delete'] = "HDD Storage Deleted Successfully";

        // Redirect to previous page
        header("location: http://localhost/pc_parts_database_generator/admin/manage-Storage.php");

    } else {
        $_SESSION['delete'] = "Failed to Delete HDD Storage";

        // Redirect to previous page
        header("location: http://localhost/pc_parts_database_generator/admin/manage-Storage.php");
    }
?>