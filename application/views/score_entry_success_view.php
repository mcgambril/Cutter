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
        echo '<p style="padding-left:40%;">';
        echo 'Player Name:  ' . $row->tempPlayerName . '<br>';
        echo 'Date:         ' . $row->tempDate . '<br>';
        echo 'Course:       ' . $row->tempCourseName . '<br>';
        echo 'Score:        ' . $row->tempScore . '<br>';
        echo 'Differential: ' . $row->tempDifferential . '<br>';
        echo 'Time:         ' . $row->tempTime . '<br><br></p>';
    }
?>
<div class="text-center">
<a class="btn btn-default" href="<?php echo base_url("index.php/score/index"); ?>">Score - Home</a>
</div>
<br><br><br>

