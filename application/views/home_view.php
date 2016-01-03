
<!--/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 7/16/2015
 * Time: 9:14 PM
 *Cutter/application/views/home_view.php
 */
 -->

<div class="page-header">
    <h1>Cutter - <small>Home</small></h1>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
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
                                                echo '
                                                    <td>' . $row->courseName . '</td>
                                                    <td>' . $row->courseSlope . '</td>
                                                    <td>' . $row->courseRating . '</td>
                                                ';
                                            }
                                        ?>
                                    </tr>
                                </tbody>
                            </table> <!--table-->
                        </div> <!--table-responsive-->
                    </div> <!--panel panel-default-->
                </div> <!--col-md-6-->
            </div> <!--row-->

            <br />

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Players</div>
                        <div class="table-responsive">
                            <table class="table table-condensed table-bordered">
                                <thead>
                                    <tr>
                                        <th class="col-md-3">See Scores</th>
                                        <th class="col-md-3">Name</th>
                                        <th class="col-md-3">Handicap</th>
                                        <th class="col-md-3">Handicap Index</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach ($getPlayersAndScoresQuery as $row) {
                                            //echo'
                                            echo '<tr data-toggle="collapse" data-target="#'.$row->playerID.'" class="accordion-toggle">';
                                                //echo '<td class="col-md-3"><button type="button" class="btn btn-default col-md-12 viewScoresBtn">Expand Scores</button></td>';
                                                echo '<td class="col-md-3"><a class="btn btn-default col-md-12 viewScoresBtn">Expand Scores</a></td>';
                                                echo '<td class="col-md-3">' . $row->playerName . '</td>';
                                                echo '<td class="col-md-3">' . $row->playerHandicap . '</td>';
                                                echo '<td class="col-md-3">' . $row->playerHandicapIndex . '</td>';
                                            echo'</tr>';
                                            echo'<tr id="'.$row->playerID.'" class="collapse noHover">';
                                                echo'<td colspan="1" class="scoresTitle">Last ' . $row->playerScoreCount . ' Score(s):  </td>';
                                                echo'<td colspan="3">';
                                                    echo '<div class="col-md-12">';
                                                        echo'<table class="table-condensed noBorders centered">';    //table-bordered
                                                        //echo'<caption style="font-weight:bold; color:#000000;">Last 20 Scores</caption>';
                                                            echo'<thead>';
                                                                echo'<tr>';
                                                                    echo'<th class="scoresHeader">Date (YYYY-MM-DD)</th>';
                                                                    echo'<th class="scoresHeader">Score</th>';
                                                                    echo'<th class="scoresHeader">Differential</th>';
                                                                echo'</tr>';
                                                            echo'</thead>';
                                                            echo'<tbody>';
                                                                foreach($row->scores as $r) {
                                                                    echo'<tr>';
                                                                        echo'<td class="col-md-4">'.$r->scoreDate.'</td>';
                                                                        echo'<td class="col-md-4">'.$r->scoreScore.'</td>';
                                                                        if ($r->scoreDifferentialUsed == 1) {
                                                                            echo'<td class="col-md-4">'.$r->scoreDifferential . '*</td>';
                                                                        }
                                                                        else {
                                                                            echo'<td class="col-md-4">'.$r->scoreDifferential.'</td>';
                                                                        }
                                                                    echo'</tr>';
                                                                }
                                                            echo'</tbody>';
                                                        echo'</table>';
                                                    echo '</div>';
                                                    echo'<br />';
                                                echo'</td>';
                                            echo'</tr>';
                                            //';
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div> <!--table-responsive-->
                    </div> <!--panel panel-default-->
                </div> <!--col-md-12-->
            </div> <!--row-->
        </div> <!--col-md-12-->
    </div> <!--row-->
</div> <!--container-->