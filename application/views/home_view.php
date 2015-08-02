
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
                        //echo'<div id="'.$row->playerID.'" class="panel-collapse collapse">';
                            //echo'<div class="panel-body">';
                            echo'<tr id="'.$row->playerID.'">';
                                echo'<td><table class="table-condensed table-bordered">';
                                //original echo'<table id="'.$row->playerID.'" class="table-condensed table-bordered">';
                                    echo'<thead>';
                                        echo'<tr>';
                                            echo'<th>Date</th>';
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
                                echo'</table></td><td></td><td></td><td></td>';
                            echo'</tr>';
                            //echo'</div>';
                        //echo'</div>';
                    //echo '</tr>';
                echo '</tbody>';
            echo '</table>';
        }
        ?>


         <!-- Table -->
        <!--<table class="table table-condensed table-bordered" style="border-collapse:collapse;">
            <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Handicap</th>
                    <th>Handicap Index</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $i = 0;
                $collapseID = "collapse" . $i;
                foreach($getPlayersAndScoresQuery as $row) {
                    echo '<tr data-toggle="collapse" data-target="#demo1" class="accordion-toggle">';
                        echo '<td><button type="button" class="btn btn-default">Scores</button></td>';
                        echo '<td>'.$row->name.'</td>';
                        echo '<td>'.$row->handicap.'</td>';
                        echo '<td>'.$row->handicapIndex.'</td>';
                    foreach($row->scores as $r) {
                        echo '</tr>';
                        //echo $r->date . ', ';
                       // echo $r->score . ', ';
                       // echo $r->differential . ', ';
                            echo '<td  class="hiddenRow"><div class="accordion-body collapse" id="">' . $r->date . '</div> </td>';
                            echo '<td  class="hiddenRow"><div class="accordion-body collapse" id="demo1">' . $r->score . '</div> </td>';
                            echo '<td  class="hiddenRow"><div class="accordion-body collapse" id="demo1">' . $r->differential . '</div> </td>';
                        //colspan = "6"
                        echo '</tr>';
                        $i++;
                    }

                }
            ?>

            </tbody>
        </table>-->
        </div>

        <?php
        foreach ($getPlayerScoresQuery as $row) {
            echo $row->date; echo '</br>';
            echo $row->score; echo '</br>';
            echo $row->differential; echo '</br>';

        }
        $i=0;
        foreach($IDs as $row) {
            echo $row->playerID . ' (' . $i . '), ';
        }

        foreach($getPlayersAndScoresQuery as $row) {
            echo $row->name . ', ';
            foreach($row->scores as $r) {
                echo $r->date . ', ';
                echo $r->score . ', ';
                echo $r->differential . ', ';
            }
            echo '</br>';
        }
        ?>






