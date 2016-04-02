<!--
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 7/28/2015
 * Time: 9:30 PM
 */
 -->

<div class="container">
    <div class="page-header">
        <h1>Course - <small>Edit <?php echo $courseName ?></small></h1>
    </div>
    <?php echo form_open('course/submitCourseEdit') ?>
        <div class="form-group">
            <div class="container">
                <div class="row col-md-8">
                    <?php echo validation_errors(); ?>
                    <div class="panel panel-default">
                        <div class="panel-heading"><?php echo $courseName ?> Course Information</div>

                            <?php foreach($getCourseQuery as $row) {
                                echo '<input type="hidden" name="courseID" value="' . $row->courseID . '" />';
                                echo'
                                    <div class="table-responsive">
                                        <table class ="table table-condensed table-bordered" style = "border-collapse:collapse;">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Current Info</th>
                                                    <th>Edit</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">Name:  </th>
                                                    <td>' . $row->courseName . '</td>
                                                    <td><input type="text" name="newCourseName" id="newCourseName" class="form-control"></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Slope:  </th>
                                                    <td>' . $row->courseSlope . '</td>
                                                    <td><input type="text" name="newCourseSlope" id="newCourseSlope" class="form-control"></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Rating:  </th>
                                                    <td>' . $row->courseRating . '</td>
                                                    <td><input type="text" name="newCourseRating" id="newCourseRating" class="form-control"></td>
                                                </tr>
                                            </tbody >
                                        </table >
                                    </div >';
                            }?>
                        </div>
                    <br>
                    <div class="text-center col-md-12">
                        <p class="col-md-2"></p>
                        <input type="submit" class="btn btn-default col-md-4" value="Submit Course Changes" name="submitName">
                        <a class="btn btn-default col-md-4" href="<?php echo base_url("course/index"); ?>">Back</a>
                        <p class="col-md-2"></p>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
