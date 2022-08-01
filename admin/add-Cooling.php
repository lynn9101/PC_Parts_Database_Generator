<?php 
    include('partials/add-header.php');
?>

        <!-- Banner Section -->
        <div class="page-banner">
            <div class="banner-text">
                <h1>Cooling</h1>
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
                        <td>Model Name</td>
                        <td><input required type="text" name="model_name" placeholder="enter cooling model name"></td>
                    </tr>
                    <tr>
                        <td>Colour</td>
                        <td><input required type="text" name="colour" placeholder="enter model colour"></td>
                    </tr>
                    <tr>
                        <td>Noise Level</td>
                        <td><input required type="text" name="noise_level" placeholder="enter model noise level (e.g. 15Db)"></td>
                    </tr>
                </table>
                <!--confirm button-->
                <br>
                <input type="submit" name="submit" value="Confirm" class="btn">
            </form>
        </section>
        <!--End Main Content Section-->

<?php include('partials/footer.php'); ?>
<?php
    ob_start();
    // Check whether the confirm button is clicked or not
    if (isset($_POST['submit'])) {
        // Get the data from the form
        $model = $_POST['model'];
        $colour = $_POST['colour'];
        $noise_level = $_POST['noise_level'];
    }