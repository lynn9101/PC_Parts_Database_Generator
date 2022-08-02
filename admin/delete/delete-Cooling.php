<?php
    include('C:\xampp\htdocs\pc_parts_database_generator\config\connect.php');
    // Get the Case ID to be deleted
    echo $model = $_GET['model'];
    echo $color = $_GET['color'];
    
    // Create SQL Query
    $sql = "DELETE FROM CoolingSystem2 WHERE modelname='$model' AND colour='$color'";
    $sql2 = "DELETE FROM CoolingSystem1 WHERE modelname='$model'";
    $conn = OpenCon();
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $result2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));

    // Redirect back to the suppliers-list.php after deletion
    if ($result == TRUE && $result2 == TRUE) {
        $_SESSION['delete'] = "Cooling System Deleted Successfully";

        // Redirect to previous page
        header("location: http://localhost/pc_parts_database_generator/admin/manage-Cooling.php");

    } else {
        $_SESSION['delete'] = "Failed to Delete Case";

        // Redirect to previous page
        header("location: http://localhost/pc_parts_database_generator/admin/manage-Cooling.php");
    }
?>