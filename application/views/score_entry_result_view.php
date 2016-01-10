<!--
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 7/28/2015
 * Time: 9:24 PM
 */
 -->
<div class="text-center">
    <h1>Success!</h1>
    <br>
    <h2>The following scores were successfully entered into the database:</h2>
</div>
<br>

<?php
    foreach ($getTempScoresQuery as $row) {
        echo '<div class="row">';
            echo '<div class="col-md-12">'; //class="resultDataTable"
                echo '<p class="col-md-5"></p>';
                echo '<table class="col-md-4 noPadLeft">';
                    echo '<tbody>';
                        echo '<tr>';
                            echo '<td class="col-md-3 resultDataPad">Player Name....</td>';
                            echo '<td class="col-md-9 resultDataPad">' . $row->tempPlayerName . '</td>';
                        echo '</tr>';
                        echo '<tr>';
                            echo '<td class="col-md-3 resultDataPad">Date..................</td>';
                            echo '<td class="col-md-9 resultDataPad">' . $row->tempDate . '</td>';
                        echo '</tr>';
                        echo '<tr>';
                            echo '<td class="col-md-3 resultDataPad">Course..............</td>';
                            echo '<td class="col-md-9 resultDataPad">' . $row->tempCourseName . '</td>';
                        echo '</tr>';
                        echo '<tr>';
                            echo '<td class="col-md-3 resultDataPad">Score................</td>';
                            echo '<td class="col-md-9 resultDataPad">' . $row->tempScore . '</td>';
                        echo '</tr>';
                        echo '<tr>';
                            echo '<td class="col-md-3 resultDataPad">Differential........</td>';
                            echo '<td class="col-md-9 resultDataPad">' . $row->tempDifferential . '</td>';
                        echo '</tr>';
                        echo '<tr>';
                            echo '<td class="col-md-3 resultDataPad">Time.................</td>';
                            echo '<td class="col-md-9 resultDataPad">' . $row->tempTime . '</td>';
                        echo '</tr>';
                    echo '</tbody>';
                echo '</table>';
                echo '<p class="col-md-3"></p>';
            echo '</div>';
        echo '</div>';
        echo'<br>';
    }
?>

<div class="row">
    <div class="text-center col-md-12">
        <p class="col-md-5"><br><br><br></p>
        <a class="btn btn-default col-md-2" href="<?php echo base_url("index.php/score/chooseDate"); ?>">Score - Home</a>
        <p class="col-md-5"></p>
    </div>
    <br><br><br>
</div>
<br><br><br>

