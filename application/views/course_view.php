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
        <h1>Course - <small>Home</small></h1>
    </div>
    <div class="col-md-4 col-xs-12 noPadLeft bottomPadTiny">
        <a class="btn btn-default col-xs-6 col-md-6" href="<?php echo base_url("course/add"); ?>">Add Course</a>
        <a class="btn btn-default col-xs-6 col-md-6" href="<?php echo base_url("course/setHomeCourse"); ?>">Update Home</a>
    </div>

    <div class="row">
        <div class="col-md-8 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">All Courses</div>

                <div class="table" style="overflow:auto;">
                <table class ="table table-condensed table-bordered smallFont noBottomMargin" style="border-collapse:collapse;">
                    <thead>
                        <tr>
                            <th class="col-md-4">Name</th>
                            <th class="col-md-1 centered">Slope</th>
                            <th class="col-md-1 centered">Rating</th>
                            <th class="col-md-1 centered">Par</th>
                            <th class="col-md-2 centered">Home Course</th>
                            <!--<th class="col-md-4 centered" colspan="2">Actions</th>-->
                            <th class="col-md-4 centered">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if ($noCourses == TRUE) {
                        echo'
                            <tr>
                                <td colspan="6" class="centered">No courses exist in the system.</td>
                            </tr>
                        ';
                    }
                    else {
                        foreach ($getCoursesQuery as $row) {
                            echo '
                                <tr>
                                    <td class="col-md-4">' . $row->courseName . '</td>
                                    <td class="col-md-1 centered">' . $row->courseSlope . '</td>
                                    <td class="col-md-1 centered">' . $row->courseRating . '</td>
                                    <td class="col-md-1 centered">' . $row->coursePar . '</td>
                                    <td class="col-md-2 centered">' . $row->courseDefault . '</td>
                                    <td class="col-md-4">
                                        <a class="btn btn-default smallFont col-xs-12 col-md-6" href="' . base_url("course/edit/" . $row->courseID) . '">Edit</a>
                                        <a class="btn btn-default smallFont col-xs-12 col-md-6 disabled" href="' . base_url("course/delete/" . $row->courseID) . '">Delete</a>
                                    </td>
                                </tr>
                            ';
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