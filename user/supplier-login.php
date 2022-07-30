<?php include('partials-frontend/header.php'); ?>

    <!-- Banner Section -->
    <section class="banner">
        <div class="banner-contain container">
            <div class="banner-left">
                <h1>Add Supplier</h1>
                
                <br>
                <form action="" method="POST">

                    <table class="table-container">
                        <tr>
                            <td>Supplier Name: </td>
                            <td><input type="text" name="supplier_name" placeholder="Enter your supplier name"></td>
                        </tr>

                        <tr>
                            <td>Contact Information: </td>
                            <td><input type="text" name="contact_info" placeholder="Enter your email here"></td>
                        </tr>

                        <tr>
                            <td>Address: </td>
                            <td><input type="text" name="supplier_address" placeholder="Enter your address here"></td>
                        </tr>

                        <tr>
                            <td>Password: </td>
                            <td><input type="password" name="password" placeholder="Enter password"></td>
                        </tr>
                        
                        <!-- Add a Confirm button -->
                        <tr>
                            <td><input type="submit" name="submit" value="Add Supplier" class="btn-primary"></td>
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

<?php include('partials-frontend/footer.php'); ?>