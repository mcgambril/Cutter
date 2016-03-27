
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
                <div class="col-md-4 col-xs-4">
                    <div class="col-md-3 col-xs-3 fixed">
                        <div class="col-md-12 col-xs-12">
                            <?php
                                echo '<p><strong>Date: </strong></p>';
                                echo '<input type="text" value="' . $date . '" name="datepicker"  class="form-control" readonly>';
                            ?>
                            <br />
                            <label for="pick-course">Course:</label>
                            <select class="form-control" id="pick-course" name="course">
                                <?php
                                    foreach($getCoursesQuery as $row) {
                                        if ($row->courseDefault == 1) {
                                            echo '<option selected="selected" value="' . $row->courseID . '">' . $row->courseName . '</option>';
                                        }
                                        else {
                                            echo '<option value="' . $row->courseID . '">' . $row->courseName . '</option>';
                                        }
                                    }
                                ?>
                            </select>
                            <br/>
                        </div>
                        <div class="col-md-12 col-xs-12">
                            <input type="submit" class="btn btn-default col-md-6 col-xs-6" value="Enter Scores" name="submit">
                            <a class="btn btn-default col-md-6 col-xs-6" href="<?php echo base_url("score/chooseDate"); ?>">Back</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xs-12 relative">
                    <div class="panel panel-default">

                        <div class="panel-heading">Post New Scores</div>

                        <div class="table-responsive">
                            <table class ="table table-condensed table-bordered" style="border-collapse:collapse;">
                                <thead>
                                    <tr>
                                        <th class="col-md-6 col-xs-6">Player</th>
                                        <th class="col-md-3 col-xs-3 centered">AM</th>
                                        <th class="col-md-3 col-xs-3 centered">PM</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if ($noPlayers == TRUE) {
                                            echo'
                                            <tr>
                                                <td colspan="3" class="centered">There are no players in the system.</td>
                                            </tr>
                                            ';
                                        }
                                        else {
                                            foreach($getPlayersScoresByDateQuery as $row) {
                                                if ($row->scoreSummary == 'empty'){
                                                    echo '<tr>';
                                                    echo '<td class="col-md-6 col-xs-6">' . $row->playerName . '<input type="hidden" name="' . $row->playerID . '" value="' . $row->playerID . '" /></td>';
                                                    echo '<td class="col-md-3 col-xs-3">';
                                                    echo '<input type="text" name="' . $row->playerID . 'am-score"  id="' . $row->playerID . 'am-score" class="' . $row->playerID . 'score col-md-12">';
                                                    echo '</td>';
                                                    echo '<td class="col-md-3 col-xs-3">';
                                                    echo '<input type="text" name="' . $row->playerID . 'pm-score" id ="' . $row->playerID . 'pm-score" class="' . $row->playerID . 'score col-md-12">';
                                                    echo '</td>';
                                                    echo '</tr>';
                                                }
                                                else if ($row->scoreSummary == 'am empty'){
                                                    echo '<tr>';
                                                    echo '<td class="col-md-6 col-xs-6">' . $row->playerName . '<input type="hidden" name="' . $row->playerID . '" value="' . $row->playerID . '" /></td>';
                                                    echo '<td class="col-md-3 col-xs-3">';
                                                    echo '<input type="text" name="' . $row->playerID . 'am-score"  id="' . $row->playerID . 'am-score" class="' . $row->playerID . 'score col-md-12">';
                                                    echo '</td>';
                                                    foreach ($row->pmScore as $score){
                                                        echo '<td class="col-md-3 col-xs-3 centered">' . $score->scoreScore . '</td>';
                                                    }
                                                    echo '</tr>';
                                                }
                                                else if ($row->scoreSummary == 'pm empty'){
                                                    echo '<tr>';
                                                    echo '<td class="col-md-6 col-xs-6">' . $row->playerName . '<input type="hidden" name="' . $row->playerID . '" value="' . $row->playerID . '" /></td>';
                                                    foreach($row->amScore as $score) {
                                                        echo '<td class="col-md-3 col-xs-3 centered">' . $score->scoreScore . '</td>';
                                                    }
                                                    echo '<td class="col-md-3 col-xs-3">';
                                                    echo '<input type="text" name="' . $row->playerID . 'pm-score" id ="' . $row->playerID . 'pm-score" class="' . $row->playerID . 'score col-md-12">';
                                                    echo '</td>';
                                                    echo '</tr>';
                                                }
                                                else if ($row->scoreSummary == 'full'){
                                                    echo '<tr>';
                                                    echo '<td class="col-md-6 col-xs-6">' . $row->playerName . '<input type="hidden" name="' . $row->playerID . '" value="' . $row->playerID . '" /></td>';
                                                    foreach($row->amScore as $score) {
                                                        echo '<td class="col-md-3 col-xs-3 centered">' . $score->scoreScore . '</td>';
                                                    }
                                                    foreach ($row->pmScore as $score){
                                                        echo '<td class="col-md-3 col-xs-3 centered">' . $score->scoreScore . '</td>';
                                                    }
                                                    echo '</tr>';
                                                }
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>