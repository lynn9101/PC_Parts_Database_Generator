<?php 
    include('partials/add-header.php');
?>

        <!-- Banner Section -->
        <div class="page-banner">
            <div class="banner-text">
                <h1>Memory</h1>
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
                        <td>ID</td>
                        <td><input required type="number" name="id" placeholder="enter model ID"></td>
                    </tr>
                    <tr>
                        <td>Memory Size</td>
                        <td><input required type="text" name="size" placeholder="enter memory size (e.g. 12GB)"></td>
                    </tr>
                    <tr>
                        <td>Memory Speed</td>
                        <td><input required type="text" name="speed" placeholder="enter memory speed (e.g. 3600MHz)"></td>
                    </tr>
                    <tr>
                        <td>Form Factor</td>
                        <td><input required type="text" name="form_factor" placeholder="enter model Form Factor"></td>
                    </tr>
                </table>
                <!--confirm button-->
                <br>
                <input type="submit" name="submit" value="Confirm" class="btn">
            </form>
        </section>
        <!--End Main Content Section-->

<?php include('partials/footer.php'); ?>