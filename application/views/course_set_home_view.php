<!--
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 12/29/2015
 * Time: 2:07 AM
 */
 -->
<div class="page-header">
    <h1>Course - <small>Set Home Course</small></h1>
</div>

<?php echo validation_errors(); ?>

<?php echo form_open('course/submitSetHomeCourse') ?>
<div class="form-group">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Current Home Course</div>
                    <div class="table-responsive">
                        <table class ="table table-condensed table-bordered">
                            <thead>
                            <tr>
                                <th>Course Name</th>
                                <th>Slope</th>
                                <th>Rating</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <?php
                                    if ($emptyHome == TRUE) {
                                        echo '
                                            <td colspan="3" class="centered">No Home Course is currently set.</td>
                                        ';
                                    }
                                    else {
                                        foreach ($getHomeCourseQuery as $row) {
                                            echo '<td>' . $row->courseName . '</td>';
                                            echo '<td>' . $row->courseSlope . '</td>';
                                            echo '<td>' . $row->courseRating . '</td>';
                                        }
                                    }
                                ?>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <br><br>
                <h4>Choose the course you would like to set as the new default course:</h4>
                <div class="col-md-6 noPadLeft">
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
                </div>
                <br><br><br>
                <div>
                    <br><br>
                    <input type="submit" class="btn btn-default col-md-4" value="Set New Home Course" name="submitName">
                    <a class="btn btn-default col-md-4" href="<?php echo base_url("course/index"); ?>">Back</a>
                    <p class="col-md-2"></p>
                </div>
                <br><br><br>
            </div>
        </div>
    </div>
</div>