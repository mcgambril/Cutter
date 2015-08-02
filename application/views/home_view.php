
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

    <h2><button type="button" class="btn btn-default">Default</button></h2>

    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">Members</div>

        <!-- Table -->
        <table class="table table-condensed table-bordered" style="border-collapse:collapse;">
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
                foreach($getPlayersQuery as $row) {
                    echo '<tr data-toggle="collapse" data-target=".demo1" class="accordion-toggle">';
                        echo '<td><button type="button" class="btn btn-default">Scores</button></td>';
                        echo '<td>'.$row->name.'</td>';
                        echo '<td>'.$row->handicap.'</td>';
                        echo '<td>'.$row->handicapIndex.'</td>';
                    echo '</tr>';
                        //echo '<td colspan="6" class="hiddenRow"><div class="accordion-body collapse demo1" id="demo1"> Demo1 </div> </td>';
                        //echo'<td colspan="6" class="hiddenRow"><div class="accordion-body collapse demo1" id="demo1"> test </div> </td>';
                    echo '</tr>';
                }
            ?>

            </tbody>
        </table>
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






