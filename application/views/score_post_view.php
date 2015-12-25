
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

<?php echo validation_errors(); ?>

<?php echo form_open('score/submitPost') ?>
<div class="form-group">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="col-md-3 fixed">
                    <div class="col-md-12">
                        <?php
                            echo '<p><strong>Date: </strong></p>';
                            echo '<input type="text" value="' . $date . '" name="datepicker"  class="form-control" readonly>';
                        ?>
                        <br />
                        <label for="pick-course">Course:</label>
                        <select class="form-control" id="pick-course" name="course">
                            <?php
                                foreach($getCoursesQuery as $row) {
                                    echo '<option value="' . $row->courseID . '">' . $row->courseName . '</option>';
                                }
                            ?>
                        </select>
                        <br/>
                    </div>
                    <div class="col-md-12">
                        <input type="submit" class="btn btn-default col-md-6" value="Enter Scores" name="submit">
                        <a class="btn btn-default col-md-6" href="<?php echo base_url("index.php/score/index"); ?>">Back</a>
                    </div>
                </div>
            </div>

            <div class="col-md-8 relative">
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
                                    if ($row->scoreSummary == 'empty'){
                                        echo '<tr>';
                                            echo '<td class="col-md-2">' . $row->playerName . '<input type="hidden" name="' . $row->playerID . '" value="' . $row->playerID . '" /></td>';
                                            echo '<td class="col-md-2">';
                                                echo '<input type="checkbox" id="' . $row->playerID . '-played" data-toggle="collapse" data-target=".' . $row->playerID . 'score"/> Yes';
                                            echo '</td>';
                                            echo '<td class="col-md-2">Empty';
                                                echo '<input type="text" name="' . $row->playerID . 'am-score"  id="' . $row->playerID . 'am-score" class="form-control collapse ' . $row->playerID . 'score">';
                                            echo '</td>';
                                            echo '<td class="col-md-2">Empty';
                                                echo '<input type="text" name="' . $row->playerID . 'pm-score" id ="' . $row->playerID . 'pm-score" class="form-control collapse ' . $row->playerID . 'score">';
                                            echo '</td>';
                                        echo '</tr>';
                                    }
                                    else if ($row->scoreSummary == 'am empty'){
                                        echo '<tr>';
                                            echo '<td class="col-md-2">' . $row->playerName . '<input type="hidden" name="' . $row->playerID . '" value="' . $row->playerID . '" /></td>';
                                            echo '<td class="col-md-2">';
                                                echo '<input type="checkbox" id="' . $row->playerID . '-played" data-toggle="collapse" data-target=".' . $row->playerID . 'score"/>Yes';
                                            echo '</td>';
                                            echo '<td class="col-md-2">Empty';
                                                echo '<input type="text" name="' . $row->playerID . 'am-score"  id="' . $row->playerID . 'am-score" class="form-control collapse ' . $row->playerID . 'score">';
                                            echo '</td>';
                                            foreach ($row->pmScore as $score){
                                                echo '<td class="col-md-2">' . $score->scoreScore . '';
                                                echo '</td>';
                                            }
                                        echo '</tr>';
                                    }
                                    else if ($row->scoreSummary == 'pm empty'){
                                        echo '<tr>';
                                            echo '<td class="col-md-2">' . $row->playerName . '<input type="hidden" name="' . $row->playerID . '" value="' . $row->playerID . '" /></td>';
                                            echo '<td class="col-md-2">';
                                                echo '<input type="checkbox" id="' . $row->playerID . '-played" data-toggle="collapse" data-target=".' . $row->playerID . 'score"/>Yes';
                                            echo '</td>';
                                            foreach($row->amScore as $score) {
                                                echo '<td class="col-md-2">' . $score->scoreScore . '';
                                                echo '</td>';
                                            }
                                            echo '<td class="col-md-2">Empty';
                                                echo '<input type="text" name="' . $row->playerID . 'pm-score" id ="' . $row->playerID . 'pm-score" class="form-control collapse ' . $row->playerID . 'score">';
                                            echo '</td>';
                                        echo '</tr>';
                                    }
                                    else if ($row->scoreSummary == 'full'){
                                        echo '<tr>';
                                            echo '<td class="col-md-2">' . $row->playerName . '<input type="hidden" name="' . $row->playerID . '" value="' . $row->playerID . '" /></td>';
                                            echo '<td class="col-md-2">';
                                                echo 'Scores are full';
                                            echo '</td>';
                                            foreach($row->amScore as $score) {
                                                echo '<td class="col-md-2">' . $score->scoreScore . '';
                                                echo '</td>';
                                            }
                                            foreach ($row->pmScore as $score){
                                                echo '<td class="col-md-2">' . $score->scoreScore . '';
                                                echo '</td>';
                                            }
                                        echo '</tr>';
                                    }

                                echo '</tbody>';
                            echo '</table>';
                        echo '</div>';
                    }
                    ?>
                </div>

            </div>

        </div>
    </div>
</div>
</div>
</form>