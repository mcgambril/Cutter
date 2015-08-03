
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

    <div class="panel panel-default">
        <div class="panel-heading">Home Course</div>
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
                            echo '<td>' . $row->name . '</td>';
                            echo '<td>' . $row->slope . '</td>';
                            echo '<td>' . $row->rating . '</td>';
                        }
                    ?>
                </tr>
            </tbody>
        </table>
    </div>

    <br />
    <br />
    <br />

    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">Members</div>

        <table class ="table table-condensed table-bordered" style="border-collapse:collapse;">
            <thead>
                <tr>
                    <th class="col-md-2"></th>
                    <th class="col-md-2">Name</th>
                    <th class="col-md-2">Handicap</th>
                    <th class="col-md-2">Handicap Index</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

        <?php
            foreach($getPlayersAndScoresQuery as $row) {
                echo '<table class ="table table-condensed table-bordered" style="border-collapse:collapse;">';
                    echo '<thead>';
                    echo '</thead>';
                    echo '<tbody>';
                        echo '<tr data-toggle="collapse" data-target="#'.$row->playerID.'" class="accordion-toggle">';
                            echo '<td class="col-md-2"><button type="button" class="btn btn-default">Scores</button></td>';
                            echo '<td class="col-md-2">' . $row->name . '</td>';
                            echo '<td class="col-md-2">' . $row->handicap . '</td>';
                            echo '<td class="col-md-2">' . $row->handicapIndex . '</td>';
                        echo'</tr>';
                        echo'<tr id="'.$row->playerID.'" class="collapse">';
                            echo'<td></td>';
                            echo'<td>';
                                echo'<table class="table-condensed table-bordered">';
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
                                                echo'<td>'.$r->date.'</td>';
                                                echo'<td>'.$r->score.'</td>';
                                                echo'<td>'.$r->differential.'</td>';
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
            }
        ?>
    </div>







