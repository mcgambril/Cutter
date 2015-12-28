<!--
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 12/27/2015
 * Time: 8:27 PM
 */
 -->

<div class="container">
    <div class="page-header">
        <h1>Handicaps - <small>Home</small></h1>
    </div>

    <a class="btn btn-default col-md-3" href="<?php echo base_url("index.php/handicap/update"); ?>">Update Handicaps</a>
    <div class="page-header"><br></div>

    <!--container, row, col-->
    <!--<div class="container">
        <div class="row">-->
            <div class="col-md-6 noPadLeft">
                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading">All Players' Handicaps</div>

                    <div class="table-responsive">
                        <table class ="table table-condensed table-bordered" style="border-collapse:collapse;">
                            <thead>
                            <tr>
                                <th class="col-md-2">Player</th>
                                <th class="col-md-2">Handicap Index</th>
                                <th class="col-md-2">Handicap</th>
                            </tr>
                        </table>
                    </div>

                    <?php
                        foreach($getPlayersQuery as $row) {
                            echo'
                                <div class="table-responsive">
                                    <table class ="table table-condensed table-bordered">
                                        <thead>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="col-md-2">' . $row->playerName . '</td>
                                                <td class="col-md-2">' . $row->playerHandicapIndex . '</td>
                                                <td class="col-md-2">' . $row->playerHandicap . '</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            ';
                        }
                    ?>
                </div>
                <br><br><br>
           </div>
        <!--</div>-->
    <!--</div>-->
</div>


