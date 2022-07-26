<?php
    include ('../config/connect.php');
    // Get the Supplier ID to be deleted
    $supplier_id = $_GET['id'];

    // Create SQL Query
    $sql = "DELETE FROM manufacturer_supplies WHERE id=$supplier_id";
    $conn = OpenCon();
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    // Redirect back to the suppliers-list.php after deletion
    if ($result == TRUE) {
        $_SESSION['delete'] = "Supplier Added Successfully";

        // Redirect to previous page
        header("location:".$home_page_url.'suppliers-list.php');

    } else {
        $_SESSION['delete'] = "Failed to Delete Supplier";

        // Redirect to previous page
        header("location:".$home_page_url.'suppliers-list.php');
    }
?>