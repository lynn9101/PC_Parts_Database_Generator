<?php
    include('C:\xampp\htdocs\pc_parts_database_generator\config\connect.php');
    // Get the Motherboard ID to be deleted
    echo $id = $_GET['id'];
    echo $ff = $_GET['formfactor'];

    // Create SQL Query
    $sql = "DELETE FROM Motherboard2 WHERE id=$id";
    $conn = OpenCon();
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    // Redirect back to the suppliers-list.php after deletion
    if ($result == TRUE) {
        $_SESSION['delete'] = "Motherboard Deleted Successfully";

        // Redirect to previous page
        header("location: http://localhost/pc_parts_database_generator/admin/manage-MB.php");

    } else {
        $_SESSION['delete'] = "Failed to Delete Motherboard";

        // Redirect to previous page
        header("location: http://localhost/pc_parts_database_generator/admin/manage-MB.php");
    }
?>