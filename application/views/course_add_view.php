<!--
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 7/28/2015
 * Time: 9:30 PM
 */
 -->

<div class="page-header">
    <h1>Course - <small>Add</small></h1>
</div>

<?php echo validation_errors(); ?>

<?php echo form_open('course/submitCourseAdd') ?>
<div class="form-group">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3>Enter information for the new course below:</h3>
                <br>
                <table class="col-md-8">
                    <tbody>
                        <tr>
                            <td class="headingLeft">Course Name:  </td>
                            <td class="centered tableData">
                                <input type="text" name="courseName" id="courseName" class="form-control">
                                <br>
                            </td>
                        </tr>
                        <tr>
                            <td class="headingLeft">Slope:  </td>
                            <td class="centered tableData">
                                <input type="text" name="courseSlope" id="courseSlope" class="form-control">
                                <br>
                            </td>
                        </tr>
                        <tr>
                            <td class="headingLeft">Rating:  </td>
                            <td class="centered tableData">
                                <input type="text" name="courseRating" id="courseRating" class="form-control">
                                <br>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <br><br>
                <div class="text-center col-md-8">
                    <br><br>
                    <input type="submit" class="btn btn-default col-md-6" value="Add Course" name="submitCourse">
                    <a class="btn btn-default col-md-6" href="<?php echo base_url("index.php/course/index"); ?>">Back</a>
                    <br><br><br>
                </div>
            </div>
        </div>
    </div>
</div>
</form>