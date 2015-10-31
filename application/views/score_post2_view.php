
<!--
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 10/31/2015
 * Time: 1:24 PM
 */
 -->

<div class="page-header">
    <h1>Score - <small>Post</small></h1>
</div>

<?php print_r(array_values($getPlayersScoresByDateQuery)); ?>

<?php echo validation_errors(); ?>

<?php echo form_open('score/submitPost') ?>
<div class="form-group">
    <div class="container">
        <div class="row">

            <div class="col-md-3">
                <p>Date: <input type="text" name="datepicker" id="datepicker" class="form-control" data-date-format="yyyy-mm-dd"></p>
                <br />
                <label for="pick-course">Course:</label>
                <select class="form-control" id="pick-course" name="course">
                    <?php
                    foreach($getCoursesQuery as $row) {
                        echo '<option value="' . $row->courseID . '">' . $row->courseName . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="col-md-1">
            </div>

            <div class="col-md-8">
                <div class="panel panel-default">

                    <div class="panel-heading">Post New Scores</div>

                    <div class="table-responsive">
                        <table class ="table table-condensed table-bordered" style="border-collapse:collapse;">
                            <thead>
                            <tr>
                                <th class="col-md-2">Player</th>
                                <th class="col-md-2">Scores to Enter?</th>
                                <th class="col-md-2">AM Score</th>
                                <th class="col-md-2">PM Score</th>
                            </tr>
                        </table>
                    </div>

                    <?php
                    foreach($getPlayersScoresByDateQuery as $row) {
                        echo'<div class="table-responsive">';
                            echo '<table class ="table table-condensed table-bordered" style="border-collapse:collapse;">';
                                echo '<thead>';
                                echo '</thead>';
                                echo '<tbody>';
                                    echo '<tr>';
                                        echo '<td class="col-md-2">' . $row->playerName . '<input type="hidden" name="' . $row->playerID . '" value="' . $row->playerID . '" /></td>';
                                        echo '<td class="col-md-2">';
                                            echo '<input type="checkbox" id="' . $row->playerID . '-played" data-toggle="collapse" data-target=".' . $row->playerID . 'score"/>Yes';
                                        echo '</td>';
                                        echo '<td class="col-md-2">Empty';
                                            echo '<input type="text" name="' . $row->playerID . 'am-score"  id="' . $row->playerID . 'am-score" class="form-control collapse ' . $row->playerID . 'score">';
                                        echo '</td>';
                                        echo '<td class="col-md-2">Empty';
                                            echo '<input type="text" name="' . $row->playerID . 'pm-score" id ="' . $row->playerID . 'pm-score" class="form-control collapse ' . $row->playerID . 'score">';
                                        echo '</td>';
                                    echo '</tr>';
                                echo '</tbody>';
                            echo '</table>';
                        echo '</div>';
                    }
                    ?>
                </div>

                <div class="text-center">
                    <input type="submit" class="btn btn-default" value="Enter Scores" name="submit">
                    <a class="btn btn-default" href="<?php echo base_url("index.php/score/index"); ?>">Back</a>
                </div>
            </div>

        </div>

    </div>
</div>
</div>
</form>