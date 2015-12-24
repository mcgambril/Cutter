
<!--/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 7/16/2015
 * Time: 9:14 PM
 *Cutter/application/views/home_view.php
 */
 -->
<div class="container"> <!--<div class="container-fluid">-->
    <div class="page-header">
         <h1>Cutter - <small>Home</small></h1>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">Home Course</div>
        <div class="table-responsive">
            <table class ="table table-condensed table-bordered">
                <thead>
                    <tr>
                        <th>Course Name</th>
                        <th>Slope</th>
                        <th>Rating</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                            foreach($getHomeCourseQuery as $row) {
                                echo '<td>' . $row->courseName . '</td>';
                                echo '<td>' . $row->courseSlope . '</td>';
                                echo '<td>' . $row->courseRating . '</td>';
                            }
                        ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <br />
    <br />
    <br />

    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">Members</div>

        <div class="table-responsive">
            <table class ="table table-condensed table-bordered" style="border-collapse:collapse;">
                <thead>
                    <tr>
                        <th class="col-md-3">See Scores</th>
                        <th class="col-md-3">Name</th>
                        <th class="col-md-3">Handicap</th>
                        <th class="col-md-3">Handicap Index</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

        <?php
            foreach($getPlayersAndScoresQuery as $row) {
                echo '<div class="table-responsive">';
                    echo '<table class ="table table-condensed table-bordered" style="border-collapse:collapse;">';
                        echo '<thead>';
                        echo '</thead>';
                        echo '<tbody>';
                            echo '<tr data-toggle="collapse" data-target="#'.$row->playerID.'" class="accordion-toggle">';
                                echo '<td class="col-md-3"><button type="button" class="btn btn-default col-md-12">Scores</button></td>';
                                echo '<td class="col-md-3">' . $row->playerName . '</td>';
                                echo '<td class="col-md-3">' . $row->playerHandicap . '</td>';
                                echo '<td class="col-md-3">' . $row->playerHandicapIndex . '</td>';
                            echo'</tr>';
                            echo'<tr id="'.$row->playerID.'" class="collapse">';
                                echo'<td></td>';
                                echo'<td>';
                                    echo'<table class="table-condensed table-bordered">';
                                    echo'<caption style="font-weight:bold; color:#000000;">Last 20 Scores</caption>';
                                        echo'<thead>';
                                            echo'<tr>';
                                                echo'<th>Date (YYYY-MM-DD)</th>';
                                                echo'<th>Score</th>';
                                                echo'<th>Differential</th>';
                                            echo'</tr>';
                                        echo'</thead>';
                                        echo'<tbody>';
                                            foreach($row->scores as $r) {
                                                echo'<tr>';
                                                    echo'<td>'.$r->scoreDate.'</td>';
                                                    echo'<td>'.$r->scoreScore.'</td>';
                                                    echo'<td>'.$r->scoreDifferential.'</td>';
                                                echo'</tr>';
                                            }
                                        echo'</tbody>';
                                    echo'</table>';
                                    echo'<br />';
                                echo'</td>';
                                echo'<td></td>';
                                echo'<td></td>';
                            echo'</tr>';
                        echo '</tbody>';
                    echo '</table>';
                echo '</div>';
            }
        ?>
    </div>
</div>







