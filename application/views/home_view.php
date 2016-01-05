
<!--/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 7/16/2015
 * Time: 9:14 PM
 *Cutter/application/views/home_view.php
 */
 -->

<div class="page-header">
    <h1>Cutter Handicaps</h1>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-5">
                    <div class="panel panel-default">
                        <!--<div class="panel-heading">Home Course</div>-->
                        <div class="table-responsive">
                            <table class ="table table-condensed table-bordered">
                                <thead>
                                <tr>
                                    <th class="homeCourseHeader centered col-md-4">Course Name</th>
                                    <th class="homeCourseHeader centered col-md-4">Slope</th>
                                    <th class="homeCourseHeader centered col-md-4">Rating</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php
                                            if ($empty == TRUE) {
                                                echo '<td colspan="3" class="centered">No Home Course is currently set.</td>';
                                            }
                                            else {
                                                foreach ($getHomeCourseQuery as $row) {
                                                    echo '
                                                    <td class="centered col-md-4">' . $row->courseName . '</td>
                                                    <td class="centered col-md-4">' . $row->courseSlope . '</td>
                                                    <td class="centered col-md-4">' . $row->courseRating . '</td>
                                                ';
                                                }
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
                <div class="col-md-5">
                    <div class="panel panel-default">
                        <div class="panel-heading">Players</div>
                        <div class="table-responsive">
                            <table class="table table-condensed table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <!--<th class="col-md-3">See Scores</th>-->
                                        <th class="col-md-4">Name</th>
                                        <th class="col-md-4 centered">Handicap</th>
                                        <th class="col-md-4 centered">Index</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach ($getPlayersAndScoresQuery as $row) {
                                            //echo'
                                            echo '
                                                <tr data-toggle="collapse" data-target="#'.$row->playerID.'" class="accordion-toggle">';
                                            echo '
                                                    <!--<td class="col-md-3"><a class="btn btn-default col-md-12 viewScoresBtn">Scores Details</a></td>-->
                                                    <td class="col-md-4">' . $row->playerName . '</td>
                                                    <td class="col-md-4 centered">' . $row->playerHandicap . '</td>
                                                    <td class="col-md-4 centered">' . $row->playerHandicapIndex . '</td>
                                                </tr>';
                                            echo '
                                                <tr id="'.$row->playerID.'" class="collapse noHover">';
                                            /*<td colspan="1" class="scoresTitle">Last ' . $row->playerScoreCount . ' Score(s):  </td>*/
                                            echo '

                                                    <td colspan="3">
                                                        <p class="centered">Last ' . $row->playerScoreCount . ' Scores: </p>
                                                        <div class="col-md-12">
                                                            <table class="table-condensed noBorders centered">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="scoresHeader">Date</th>
                                                                        <th class="scoresHeader">Score</th>
                                                                        <th class="scoresHeader">Differential</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>';
                                                                foreach($row->scores as $r) {
                                                                    echo '
                                                                        <tr>
                                                                            <td class="col-md-4">'.$r->scoreDate.'</td>
                                                                            <td class="col-md-4">'.$r->scoreScore.'</td>';
                                                                        if ($r->scoreDifferentialUsed == 1) {
                                                                            echo '
                                                                                <td class="col-md-4">'.$r->scoreDifferential . '*</td>';
                                                                        }
                                                                        else {
                                                                            echo '
                                                                                <td class="col-md-4">'.$r->scoreDifferential.'</td>';
                                                                        }
                                                                    echo'</tr>';
                                                                }
                                            echo '
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <br />
                                                    </td>
                                                </tr>';
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