<table>
                <tr>
                    <th>Model</th>
                    <th>Colour</th>
                    <th>Form Factor</th>
                </tr>
                <?php
                    // Query to get all suppliers in the database
                    $sql = "SELECT c1.modelname model, c1.formfactor ff, c2.colour color 
                    FROM case1 c1
                    INNER JOIN case2 c2
                    ON c1.modelname = c2.modelname
                    $query";
                    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                    if ($result == TRUE) {
                        // Count the number of rows needed in the table
                        $numRows = mysqli_num_rows($result);

                        if ($numRows > 0) {
                            while ($rows = mysqli_fetch_assoc($result)) {
                                // Get data from each row
                                $model = $rows['model'];
                                $color = $rows['color'];
                                $ff = $rows['ff'];
                                ?>

                                <tr>
                                    <td><?php echo $model; ?></td>
                                    <td><?php echo $color; ?></td>
                                    <td><?php echo $ff; ?></td>
                                </tr>

                                <?php
                            }
                        }
                    }
                ?>
            </table>