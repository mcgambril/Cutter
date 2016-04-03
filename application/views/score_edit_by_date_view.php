<!--
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 11/23/2015
 * Time: 1:53 PM
 */
 -->

<?php echo form_open('score/submitEditScore') ?>
<div class="container">
    <div class="page-header">
        <h1>Score - <small>Edit Scores for <?php echo $date ?></small></h1>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-2 col-xs-12">
                <div class="col-md-2 col-xs-12 littlePadRight fixed">
                    <!--<br><br><br>-->
                    <input type="hidden" name="date" value="<?php echo $date ?>">
                    <?php
                        if ($empty == TRUE) {
                            echo '<input type="submit" class="btn btn-default col-md-12 col-xs-6" value="Submit Changes" disabled="disabled" name="submit">';
                        }
                        else {
                            echo '<input type="submit" class="btn btn-default col-md-12 col-xs-6" value="Submit Changes" name="submit">';
                        }
                    ?>
                    <!--<br><br>-->
                    <a class="btn btn-default col-md-12 col-xs-6" href="<?php echo base_url("score/chooseDate"); ?>">Back</a>
                    <br /><br />
                </div>
            </div>


             <div class="col-md-9 col-xs-12 relative">
                 <div class="panel panel-default">
                     <div class="panel-heading">Existing Scores for <?php echo $date ?></div>
                     <?php echo validation_errors(); ?>
                     <div class="table" style="overflow: auto;">
                         <table class ="table table-condensed table-bordered smallFont noBottomMargin" style="border-collapse:collapse;">
                             <thead>
                                 <tr>
                                     <th class="col-md-2 col-xs-2">Player</th>
                                     <!--<th class="col-md-1 col-xs-2 centered">Date</th>-->
                                     <!--<th class="col-md-2">Course</th>-->
                                     <th class="col-md-2 col-xs-1 centered">Course</th>
                                     <th class="col-md-1 col-xs-1 centered">Score</th>
                                     <th class="col-md-1 col-xs-1 centered">New Score</th>
                                     <th class="col-md-1 col-xs-1 centered">Time</th>
                                     <th class="col-md-1 col-xs-1 centered">Delete?</th>
                                 </tr>
                             </thead>

                     <?php
                        if ($empty == TRUE) {
                            echo'
                                <tr>
                                    <td  colspan="6" class="centered">There are no scores entered for ' . $date . '</td>
                                </tr>
                            ';
                        }
                        else {
                            foreach ($getFullScoreInfoByDateQuery as $row) {
                                echo '<tr>';
                                    echo '<td class="col-md-2 col-xs-2">' . $row->playerName . '</td>';
                                    //echo '<td class="col-md-1 col-xs-2 centered">' . $row->scoreDate . '</td>';
                                    echo '<td class="col-md-2 col-xs-1 centered">';
                                        echo ' <select class="form-control col-xs-12 editCourse" id="pick-course-' . $row->scoreID . '" name="course-' . $row->scoreID . '">';
                                        foreach ($getCoursesQuery as $r) {
                                            //selecting the current course as the default in the select box.  Change in db if value changes upon submitting
                                            if ($row->courseName == $r->courseName) {
                                                echo '<option class="courseOption" name="' . $r->courseName . '" selected="selected" value="' . $r->courseID . '">' . $r->courseName . '</option>';
                                            }
                                            else {
                                                echo '<option class="courseOption" name="' . $r->courseName . '" value="' . $r->courseID . '">' . $r->courseName . '</option>';
                                            }

                                        }
                                            //echo'<option value="null" disabled="disabled" class=denotation"></option>';
                                            //echo '<option value="null" disabled="disabled" id="selectedEx" class="selectedCourse denotation">Current Selected New Course</option>';
                                            //echo '<option value="null" disabled="disabled" class="denotation">' . $row->courseName . ' - Current Course in Database</option>';
                                    echo '</select></td>';
                                    echo '<td class="col-md-1 col-xs-1 centered">' . $row->scoreScore . '</td>';
                                    echo '<td class="col-md-1 col-xs-1 centered">';
                                        echo '<input type="text" class="col-md-12 col-xs-12 centered noPad" name="' . $row->scoreID . '-new-score"  id="' . $row->scoreID . '-new-score">';
                                    echo '</td>';
                                    if ($row->scoreTime == 0) {
                                        echo '<td class="col-md-1 col-xs-1 centered">AM</td>';
                                    } else {
                                        echo '<td class="col-md-1 col-xs-1 centered">PM</td>';
                                    }
                                    echo '<td class="col-md-1 col-xs-1 centered">';
                                        echo '<input type="checkbox" class="delete_box" id="' . $row->scoreID . '-delete" name="' . $row->scoreID . '-delete"  value="delete"/>';
                                    echo '</td>';
                                echo '</tr>';
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
</div>
</form>
