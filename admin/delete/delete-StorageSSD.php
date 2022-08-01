<?php
    include('C:\xampp\htdocs\pc_parts_database_generator\config\connect.php');
    // Get the GPU ID to be deleted
    echo $model = $_GET['model'];
    echo $storagesize = $_GET['size'];
    echo $ff = $_GET['ff'];

    // Create SQL Query
    $sql = "DELETE FROM SSDStorage2 WHERE model='$model' AND storagesizeGB=$storagesize AND formfactor='$ff'";
    $conn = OpenCon();
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    // Redirect back to the suppliers-list.php after deletion
    if ($result == TRUE) {
        $_SESSION['delete'] = "SSD Storage Deleted Successfully";

        // Redirect to previous page
        header("location: http://localhost/pc_parts_database_generator/admin/manage-Storage.php");

    } else {
        $_SESSION['delete'] = "Failed to Delete SSD Storage";

        // Redirect to previous page
        header("location: http://localhost/pc_parts_database_generator/admin/manage-Storage.php");
    }
?>