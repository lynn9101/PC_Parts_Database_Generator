<?php 
    include('partials/add-header.php');
?>

        <!-- Banner Section -->
        <div class="page-banner">
            <div class="banner-text">
                <h1>Storage</h1>
            </div>
        </div>
        <!-- End Banner Section -->

        <!--Main Content Section-->
        <section class="form-content text-center">
            <h2 class="activity-title">
                NEW MODEL
            </h2>
            <form action="" method="POST">
                <table>
                    <tr>
                        <td>Model</td>
                        <td><input required type="text" name="model" placeholder="enter model name"></td>
                    </tr>
                    <tr>
                        <td>Storage Size</td>
                        <td><input required type="number" name="storage_size" placeholder="enter model storage size in TB"></td>
                    </tr>
                    <tr>
                        <td>Write Speed</td>
                        <td><input required type="number" name="write_speed" placeholder="enter write speed of model in GB/s"></td>
                    </tr>
                    <tr>
                        <td>Read Speed</td>
                        <td><input required type="number" name="read_speed" placeholder="enter read speed of models in GB/s"></td>
                    </tr>
                </table>
                <!--confirm button-->
                <br>
                <input type="submit" name="submit" value="Confirm" class="btn">
            </form>
        </section>
        <!--End Main Content Section-->

<?php include('partials/footer.php'); ?>