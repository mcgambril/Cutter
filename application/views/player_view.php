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
    <div class="row">
    <div class="col-md-4 col-xs-12 bottomPadTiny">
        <a class="btn btn-default col-md-6 col-xs-6" href="<?php echo base_url("player/add"); ?>">Add Player</a>
    </div>
    </div>
    
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <div class="panel panel-default">
                <div class="table-responsive">  <!--table-responsive-->
                    <table class ="table table-condensed table-bordered">
                        <thead>
                            <tr>
                                <th class="homeCourseHeader centered col-xs-4 col-md-4">Symbol</th>
                                <th class="homeCourseHeader centered col-xs-8 col-md-8">Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($getBetsQuery == 'empty') {
                                echo '';
                            }
                            else {
                                foreach($getBetsQuery as $row) {
                                    echo '<tr>'
                                    . '     <td class="centered col-xs-4 col-md-4">' . $row->symbol . '</td>'
                                    . '     <td class="centered col-xs-8 col-md-8">' . $row->description . '</td>'
                                    . '   </tr>';
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">All Players</div>

                <div class="table" style="overflow:auto;">
                    <table class ="table table-condensed table-bordered noBottomMargin smallFont" style="border-collapse:collapse;">
                        <thead>
                            <tr>
                                <th class"centered"></th>
                                <th class="col-xs-3">Name</th>
                                <th class="col-xs-2">Phone</th>
                                <th class="col-xs-2">Handicap</th>
                                <th class="col-xs-2">Index</th>
                                <th class="col-xs-3 centered">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if ($getPlayersAZQuery == 'empty') {
                                    echo '<tr><td colspan="5">No players exist in the system</td></tr>';
                                }
                                $i = 1;
                                foreach($getPlayersAZQuery as $row) {
                                    echo '
                                        <tr>
                                            <td class="centered">' . $i . '</td>
                                            <td class="col-xs-3">' . $row->playerName . '</td>
                                            <td class="col-xs-2">' . $row->playerPhone . '</td>
                                            <td class="col-xs-2">' . $row->playerHandicap . '</td>
                                            <td class="col-xs-2">' . $row->playerHandicapIndex . '</td>
                                            <td class="col-xs-3">
                                                <a class="btn btn-default col-xs-12 col-md-6 smallFont" href="' . base_url("player/edit/".$row->playerID) . '">Edit</a>
                                                <a class="btn btn-default col-xs-12 col-md-6 smallFont" href="' . base_url("player/delete/".$row->playerID) . '">Delete</a>
                                            </td>
                                        </tr>
                                    ';
                                    $i++;
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
