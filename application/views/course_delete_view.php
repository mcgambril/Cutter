<!--
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 7/28/2015
 * Time: 9:30 PM
 */
 -->

<?php echo validation_errors(); ?>
<?php echo form_open('course/submitDelete') ?>

    <div class="container">
        <div class="page-header">
            <?php foreach($getCourseQuery as $row) {
                echo '<h1>' . $row->courseName . ' - <small>Delete</small></h1>';
            }?>
        </div>

        <?php foreach($getCourseQuery as $row) {
            echo '
                <div class="form-group">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="panel panel-default">
                                    <div class="panel-heading">' . $row->courseName . '&#39s Current Information</div>
                                    <div class="table-responsive">
                                        <table class ="table table-condensed table-bordered" style="border-collapse:collapse;">
                                            <thead>
                                                <tr>
                                                    <th class="col-md-2">Name</th>
                                                    <th class="col-md-2">Slope</th>
                                                    <th class="col-md-2">Rating</th>
                                                    <th class=col-md-2">Home Course?</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="col-md-2">' . $row->courseName . '</td>
                                                    <td class="col-md-2">' . $row->courseSlope . '</td>
                                                    <td class="col-md-2">' . $row->courseRating . '</td>
                                                    <td class="col-md-2 centered">' . $row->courseDefault . '</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }?>

    </div>

    <div class="form-group">
        <div class="container">
            <div class="row">
                <div class="text-center col-md-8">
                    <h3>Are you sure you want to Delete this course from the database?</h3>
                    <br>
                    <?php echo '<input type = "hidden" name = "courseID" value = "' . $row->courseID . '" />'; ?>
                    <p class="col-md-2"></p>
                    <input type="submit" class="btn btn-default col-md-4" value="Yes. Delete Course" name="submitName">
                    <a class="btn btn-default col-md-4" href="<?php echo base_url("index.php/course/index"); ?>">Back</a>
                    <p class="col-md-2"></p>
                </div>
            </div>
        </div>
    </div>
</form>