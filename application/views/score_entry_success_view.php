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
        echo '<table class="col-md-2">';
        echo '<th></th>';
        echo '<tbody>';
            echo '<tr>';
                echo '<td>Player Name....</td>';
                echo '<td>' . $row->tempPlayerName . '</td>';
            echo '</tr>';
            echo '<tr>';
                echo '<td>Date..................</td>';
                echo '<td>' . $row->tempDate . '</td>';
            echo '</tr>';
            echo '<tr>';
                echo '<td>Course..............</td>';
                echo '<td>' . $row->tempCourseName . '</td>';
            echo '</tr>';
            echo '<tr>';
                echo '<td>Score................</td>';
                echo '<td>' . $row->tempScore . '</td>';
            echo '</tr>';
            echo '<tr>';
                echo '<td>Differential........</td>';
                echo '<td>' . $row->tempDifferential . '</td>';
            echo '</tr>';
            echo '<tr>';
                echo '<td>Time.................</td>';
                echo '<td>' . $row->tempTime . '</td>';
            echo '</tr>';
        echo '</tbody>';
        echo '</table>';
        echo '';
        echo '<p class="col-md-5></p>';
        echo '';
        echo '</div>';
        echo '</div>';
    }
?>

<div class="row">
    <div class="text-center col-md-12">
    <p class="col-md-5"><br><br><br></p>
    <a class="btn btn-default col-md-2" href="<?php echo base_url("index.php/score/index"); ?>">Score - Home</a>
    <p class="col-md-5"></p>
    </div>
    <br><br><br>
</div>
<br><br><br>

