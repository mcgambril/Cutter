<!--
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 7/28/2015
 * Time: 9:30 PM
 */
 -->

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
                            <div class=" noPadLeft col-xs-12 col-md-8">
                            <strong style="color:red">';
                            echo validation_errors();
                                echo'</strong>
                                    <div class="panel panel-default">
                                    <div class="panel-heading">' . $row->courseName . '&#39s Current Information</div>
                                    <div class="table" style="overflow:auto;">
                                        <table class ="table table-condensed table-bordered smallFont noBottomMargin" style="border-collapse:collapse;">
                                            <thead>
                                                <tr>
                                                    <th class="col-xs-3 col-md-2">Name</th>
                                                    <th class="col-xs-3 col-md-2">Slope</th>
                                                    <th class="col-xs-3 col-md-2">Rating</th>
                                                    <th class="col-xs-3 col-md-2">Home Course?</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="col-xs-3 col-md-2">' . $row->courseName . '</td>
                                                    <td class="col-xs-3 col-md-2">' . $row->courseSlope . '</td>
                                                    <td class="col-xs-3 col-md-2">' . $row->courseRating . '</td>
                                                    <td class="col-xs-3 col-md-2 centered">' . $row->courseDefault . '</td>
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
                <div class="col-xs-12 col-md-8">
                    <h3>Are you sure you want to Delete this course from the database?</h3>
                    <br>
                    <?php echo '<input type = "hidden" name = "courseID" value = "' . $row->courseID . '" />'; ?>
                    <input disabled type="submit" class="btn btn-default col-xs-6 col-md-3" value="Delete" name="submitName">
                    <a class="btn btn-default col-xs-6 col-md-3" href="<?php echo base_url("course/index"); ?>">Back</a>
                </div>
            </div>
        </div>
    </div>
</form>