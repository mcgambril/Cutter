<!--
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 7/28/2015
 * Time: 9:23 PM
 */
 -->

<div class="container">
    <div class="page-header">
        <h1>Score - <small>Edit</small></h1>
    </div>

    <?php echo validation_errors(); ?>
    <?php echo form_open('course/submitScoreEditIndividual') ?>
    <div class="form-group">
        <div class="container">
            <div class="row col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Score Information</div>

                    <?php foreach($getFullScoreInfoByIDQuery as $row) {
                        echo '<input type="hidden" name="courseID" value="' . $row->scoreID . '" />';
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
                                                    <th scope="row">Player:  </th>
                                                    <td>' . $row->playerName . '</td>
                                                    <td><input type="text" name="newPlayerName" id="newPlayerName" class="form-control"></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Date:  </th>
                                                    <td>' . $row->scoreDate . '</td>
                                                    <td><input type="text" name="datepicker" id="datepicker" class="form-control" data-date-format="yyyy-mm-dd"></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Course:  </th>
                                                    <td>' . $row->courseName . '</td>
                                                    <td>
                                                        <select class="form-control" id="pick-course" name="course">';
                                                            foreach($getCoursesQuery as $r) {
                                                                echo '<option value="' . $r->courseID . '">';
                                                                    echo $r->courseName;
                                                                echo '</option>';
                                                            }
                                                        echo '</select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Score:  </th>
                                                    <td>' . $row->scoreScore . '</td>
                                                    <td><input type="text" name="newScore" id="newScore" class="form-control"></td >
                                                </tr >
                                            </tbody >
                                        </table >
                                    </div >';
                    }?>
                </div>
                <br>
                <div class="text-center col-md-12">
                    <p class="col-md-2"></p>
                    <input type="submit" class="btn btn-default col-md-4" value="Submit Course Changes" name="submitName">
                    <a class="btn btn-default col-md-4" href="<?php echo base_url("index.php/score/index"); ?>">Back</a>
                    <p class="col-md-2"></p>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>