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
        <a class="btn btn-default col-md-3" href="<?php echo base_url("index.php/player/Add"); ?>">Add Player</a>
        <br>
        <br>
    </div>

    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">All Players</div>

        <div class="table-responsive">
            <table class ="table table-condensed table-bordered" style="border-collapse:collapse;">
                <thead>
                <tr>
                    <th class="col-md-2">Name</th>
                    <th class="col-md-1">Handicap</th>
                    <th class="col-md-1">Handicap Index</th>
                    <th class="col-md-1">Edit</th>
                    <th class="col-md-1">Delete</th>
                </tr>
            </table>
        </div>

        <?php foreach($getPlayersQuery as $row) {
            echo'<div class="table-responsive">';
                echo '<table class ="table table-condensed table-bordered">';
                    echo '<thead>';
                    echo '</thead>';
                    echo '<tbody>';
                        echo '<tr>';
                            echo '<td class="col-md-2">' . $row->playerName . '</td>';
                            echo '<td class="col-md-1">' . $row->playerHandicap . '</td>';
                            echo '<td class="col-md-1">' . $row->playerHandicapIndex . '</td>';
                            echo '<td class="col-md-1">';
                                echo '<a class="btn btn-default col-md-12" href="' . base_url("index.php/player/edit/".$row->playerID) . '">Edit</a>';
                            echo '</td>';
                            echo '<td class="col-md-1">';
                                echo '<a class="btn btn-default col-md-12" href="' . base_url() . '">Delete</a>';
                            echo '</td>';
                        echo '</tr>';
                    echo '</tbody>';
                echo '</table>';
            echo '</div>';
        }
        ?>
    </div>
</div>
