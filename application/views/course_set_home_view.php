<!--
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 12/29/2015
 * Time: 2:07 AM
 */
 -->


<?php echo form_open('course/submitSetHomeCourse') ?>
<div class="form-group">
    <div class="container">
        <div class="page-header">
            <h1>Course - <small>Set Home Course</small></h1>
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-6">
                <strong style="color:red"><?php echo validation_errors(); ?></strong>
                <div class="panel panel-default">
                    <div class="panel-heading">Current Home Course</div>
                    <div class="table" style="overflow:auto;">
                        <table class ="table table-condensed table-bordered noBottomMargin">
                            <thead>
                            <tr>
                                <th class="col-xs-6">Course Name</th>
                                <th class="col-xs-3">Slope</th>
                                <th class="col-xs-3">Rating</th>
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
                                            echo '<td class="col-xs-6">' . $row->courseName . '</td>';
                                            echo '<td class="col-xs-3">' . $row->courseSlope . '</td>';
                                            echo '<td class="col-xs-3">' . $row->courseRating . '</td>';
                                        }
                                    }
                                ?>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

                <div class="row bottompadTiny">
                    <div class="col-xs-12 col-md-6 bottomPadTiny">
                        <h4>Choose the course you would like to set as the new default course:</h4>
                        <div class="col-md-6 col-xs-12 noPadLeft">
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
                        <div class="col-xs-6 col-md-6 bottomPadTiny"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-3">
                        <input type="submit" class="btn btn-default col-xs-6 col-md-6" value="Update" name="submitName">
                        <a class="btn btn-default col-xs-6 col-md-6" href="<?php echo base_url("course/index"); ?>">Back</a>
                    </div>
                </div>

            <!--</div>-->
        <!--</div>-->
    </div>
</div>