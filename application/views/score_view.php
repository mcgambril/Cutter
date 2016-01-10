<!--
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 7/28/2015
 * Time: 9:22 PM
 */
 -->
<div class="container">
    <div class="page-header">
        <h1>Score - <small>Home</small></h1>
    </div>

    <a class="btn btn-default col-md-3" href="<?php echo base_url("index.php/score/postDate"); ?>">Post Scores</a>
    <a class="btn btn-default col-md-3" href="<?php echo base_url("index.php/score/chooseEditDate"); ?>">Edit Scores By Date</a>
    <div class="page-header"><br></div>

    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">All Players' Scores</div>

        <div class="table-responsive">
            <table class ="table table-condensed table-bordered" style="border-collapse:collapse;">
                <thead>
                <tr>
                    <th class="col-md-2">Player</th>
                    <th class="col-md-2">Date</th>
                    <th class="col-md-2">Course</th>
                    <th class="col-md-2">Score</th>
                    <th class="col-md-2 centered">Actions</th>
                </tr>
            </table>
        </div>

        <?php foreach($getFullScoreInfoQuery as $row) {
            echo'<div class="table-responsive">
                <table class ="table table-condensed table-bordered">
                    <thead>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="col-md-2">' . $row->playerName . '</td>
                            <td class="col-md-2">' . $row->scoreDate . ' - ' . $row->scoreTime . '</td>
                            <td class="col-md-2">' . $row->courseName . '</td>
                            <td class="col-md-2">' . $row->scoreScore . '</td>
                            <td class="col-md-2">
                                <a class="btn btn-default col-md-12" href="' . base_url("index.php/score/edit/".$row->scoreID) . '">Edit</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>';
            }
        ?>
        </div>
    </div>
</div>

