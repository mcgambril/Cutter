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
        /*echo '<p style="padding-left:40%;">';
        echo 'Player Name:  ' . $row->tempPlayerName . '<br>';
        echo 'Date:  ' . $row->tempDate . '<br>';
        echo 'Course:  ' . $row->tempCourseName . '<br>';
        echo 'Score:  ' . $row->tempScore . '<br>';
        echo 'Differential:  ' . $row->tempDifferential . '<br>';
        echo 'Time:  ' . $row->tempTime . '<br><br></p>';*/

        echo '<div style="padding-left:40%;">';
        echo '<table>';
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
        echo '<br>';
        echo '</div>';
    }
?>


<div class="text-center">
<a class="btn btn-default" href="<?php echo base_url("index.php/score/index"); ?>">Score - Home</a>
</div>
<br><br><br>

