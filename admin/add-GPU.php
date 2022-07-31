<?php 
    include('partials/add-header.php');
?>

        <!-- Banner Section -->
        <div class="page-banner">
            <div class="banner-text">
                <h1>GPU</h1>
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
                        <td><input required type="number" name="memory_size" placeholder="enter model memory size in GB"></td>
                    </tr>
                    <tr>
                        <td>Memory Type</td>
                        <td><input required type="text" name="memory_type" placeholder="enter memory type of the model"></td>
                    </tr>
                    <tr>
                        <td>Boost Clock</td>
                        <td><input required type="number" name="boost_clock" placeholder="enter boost clock of model in MHz"></td>
                    </tr>
                    <tr>
                        <td>Core Clock</td>
                        <td><input required type="number" name="core_clock" placeholder="enter core clock of model in MHz"></td>
                    </tr>
                    <tr>
                        <td>Integrated/ Dedicated</td>
                        <td>
                            <select name="dedicated">
                                <option value="1">Integrated</option>
                                <option value="2">Dedicated</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>CPU</td>
                        <td>
                            <select name="cpu_goes_with">
                                <option value="1">Placeholder</option>
                                <option value="2">Placeholder</option>
                            </select>
                        </td>
                    </tr>
                    
                </table>
                <!--confirm button-->
                <br>
                <input type="submit" name="submit" value="Confirm" class="btn">
            </form>
        </section>
        <!--End Main Content Section-->

<?php include('partials/footer.php'); ?>