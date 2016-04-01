<!--
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 7/28/2015
 * Time: 9:27 PM
 */
 -->

<div class="container">
    <div class="page-header">
        <h1>Player - <small>Home</small></h1>
    </div>
    <div class="col-md-4 col-xs-12 noPadLeft bottomPadTiny">
        <a class="btn btn-default col-md-6 col-xs-6" href="<?php echo base_url("player/add"); ?>">Add Player</a>
    </div>

    <div class="row">
        <div class="col-md-8 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">All Players</div>

                <div class="table-responsive">
                    <table class ="table table-condensed table-bordered" style="border-collapse:collapse;">
                        <thead>
                            <tr>
                                <th class="col-md-4">Name</th>
                                <th class="col-md-2">Handicap</th>
                                <th class="col-md-2">Index</th>
                                <th class="col-md-4 centered" colspan="2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if ($getPlayersAZQuery == 'empty') {
                                    echo '<tr><td colspan="5">No players exist in the system</td></tr>';
                                }
                                foreach($getPlayersAZQuery as $row) {
                                    echo '
                                        <tr>
                                            <td class="col-md-4">' . $row->playerName . '</td>
                                            <td class="col-md-2">' . $row->playerHandicap . '</td>
                                            <td class="col-md-2">' . $row->playerHandicapIndex . '</td>
                                            <td class="col-md-2">
                                                <a class="btn btn-default col-md-12" href="' . base_url("player/edit/".$row->playerID) . '">Edit</a>
                                            </td>
                                            <td class="col-md-2">
                                                <a class="btn btn-default col-md-12" href="' . base_url("player/delete/".$row->playerID) . '">Delete</a>
                                            </td>
                                        </tr>
                                    ';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
