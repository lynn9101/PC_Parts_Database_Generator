<?php 
    include('partials/add-header.php');
?>

        <!-- Banner Section -->
        <div class="page-banner">
            <div class="banner-text">
                <h1>Power Supply</h1>
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
                        <td><input required type="text" name="model" placeholder="enter model name"></td>
                    </tr>
                    <tr>
                        <td>Watts</td>
                        <td><input required type="number" name="watts" placeholder="enter the number in Watts"></td>
                    </tr>
                    <tr>
                        <td>Modularity</td>
                        <td>
                            <select name="modularity">
                                <option value="1">No</option>
                                <option value="2">Semi</option>
                                <option value="3">Full</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Model Colour</td>
                        <td><input required type="text" name="colour" placeholder="enter colour of model"></td>
                    </tr>
                </table>
                <!--confirm button-->
                <br>
                <input type="submit" name="submit" value="Confirm" class="btn">
            </form>
        </section>
        <!--End Main Content Section-->

<?php include('partials/footer.php'); ?>