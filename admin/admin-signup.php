<?php include('partials/header.php'); ?>

<!-- Banner Section -->
<section class="banner">
    <div class="banner-contain container">
        <div class="banner-left">
            <h1>Add Admin</h1>
            
            <br>
            <form action="" method="POST">

                <table class="table-container">
                    <tr>
                        <td>Username: </td>
                        <td><input type="text" name="user_name" placeholder="Enter your username"></td>
                    </tr>

                    <tr>
                        <td>Fullname: </td>
                        <td><input type="text" name="full_name" placeholder="Enter your full name"></td>
                    </tr>

                    <tr>
                        <td>Password: </td>
                        <td><input type="password" name="password" placeholder="Enter password"></td>
                    </tr>
                    
                    <!-- Add a Confirm button -->
                    <tr>
                        <td><input type="submit" name="submit" value="Add Admin" class="btn-primary"></td>
                    </tr>
                </table>
            </form>
        </div>

        <div class="banner-right">
            <img src="../images/banner-logo.png" alt="Banner Logo" class="img-contain">
        </div>
    </div>
</section>
<!-- End Banner Section -->

<?php include('partials/footer.php'); ?>


<?php
    // Process the value from the above form and save it to Database
    // First check whether the Add Admin button is clicked or not
    
?>