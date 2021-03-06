<!--
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 7/28/2015
 * Time: 9:25 PM
 */
 -->
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <h3 class="centered">Handicap Update Results for each player are shown below:</h3>
            <!--<div>-->
                <table class="centerMargin">
                    <thead>
                        <tr>
                            <th class="centered bottomPadTiny">Player</th>
                            <th class="centered bottomPadTiny">Result</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if($updatedHandicaps != NULL) {
                                foreach ($updatedHandicaps as $row) {
                                    echo'
                                        <tr class="handicapTable">
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
            <!--</div>-->
        </div>
    <!--</div>-->
</div>
<br><br><br>

<!--<div class="row">-->
    <div class="text-center col-md-12">
        <p class="col-md-5"></p>
        <a class="btn btn-default col-md-2" href="<?php echo base_url("handicap/update"); ?>">Back to Handicap Update</a>
        <p class="col-md-5"></p>
    </div>
</div>
<br><br><br>
