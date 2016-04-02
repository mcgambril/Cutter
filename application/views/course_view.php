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
    <div class="col-md-4 noPadLeft bottomPadTiny">
        <a class="btn btn-default col-md-6" href="<?php echo base_url("course/add"); ?>">Add Course</a>
        <a class="btn btn-default col-md-6" href="<?php echo base_url("course/setHomeCourse"); ?>">Update Home Course</a>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">All Courses</div>

                <div class="table-responsive">
                <table class ="table table-condensed table-bordered" style="border-collapse:collapse;">
                    <thead>
                        <tr>
                            <th class="col-md-4">Name</th>
                            <th class="col-md-1 centered">Slope</th>
                            <th class="col-md-1 centered">Rating</th>
                            <th class="col-md-2 centered">Home Course</th>
                            <th class="col-md-4 centered" colspan="2">Actions</th>
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
                                    <td class="col-md-2 centered">' . $row->courseDefault . '</td>
                                    <td class="col-md-2">
                                        <a class="btn btn-default col-md-12" href="' . base_url("course/edit/" . $row->courseID) . '">Edit</a>
                                    </td>
                                    <td class="col-md-2">
                                        <a class="btn btn-default col-md-12" href="' . base_url("course/delete/" . $row->courseID) . '">Delete</a>
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