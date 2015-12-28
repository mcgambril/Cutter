<!--
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 7/28/2015
 * Time: 9:25 PM
 */
 -->

<h3 class="centered">Handicap Update Results for each player are shown below:</h3>
<br><br>
<div class="resultDataTable">
    <table>
        <thead>
            <th>Player</th>
            <th class="centered">Result</th>
        </thead>
        <tbody>
            <?php
                if($updatedHandicaps != NULL) {
                    foreach ($updatedHandicaps as $row) {
                        echo'
                            <tr>
                                <td>' . $row->playerName . '</td>
                                <td class="leftPadTiny">Successfully Updated</td>
                            </tr>
                        ';
                    }
                }
                if ($errorUpdates != NULL) {
                    foreach ($errorUpdates as $row) {
                        echo '
                            <tr>
                                <td>' . $row->playerName . '</td>
                                <td>Update Failed</td>
                            </tr>
                        ';
                    }
                }
            ?>
        </tbody>
    </table>
</div>
<br><br><br>

<div class="text-center col-md-12">
    <p class="col-md-4"></p>
    <a class="btn btn-default col-md-2" href="<?php echo base_url("index.php/handicap/index"); ?>">Handicap - Home</a>
    <a class="btn btn-default col-md-2" href="<?php echo base_url("index.php/handicap/update"); ?>">Back to Handicap Update</a>
    <p class="col-md-4"></p>
</div>
<br><br><br>
