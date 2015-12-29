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
    <a class="btn btn-default col-md-3" href="<?php echo base_url("index.php/course/add"); ?>">Add Course</a>
    <a class="btn btn-default col-md-3" href="<?php echo base_url("index.php/course/setHomeCourse"); ?>">Update Home Course</a>
    <div class="page-header"><br></div>

    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">All Courses</div>

        <div class="table-responsive">
            <table class ="table table-condensed table-bordered" style="border-collapse:collapse;">
                <thead>
                <tr>
                    <th class="col-md-2">Name</th>
                    <th class="col-md-1">Slope</th>
                    <th class="col-md-1">Rating</th>
                    <th class="col-md-1 centered">Home Course</th>
                    <th class="col-md-2 centered" colspan="2">Actions</th>
                </tr>
            </table>
        </div>

        <?php foreach($getCoursesQuery as $row) {
            echo'<div class="table-responsive">';
                echo '<table class ="table table-condensed table-bordered">';
                    echo '<thead>';
                    echo '</thead>';
                    echo '<tbody>';
                        echo '<tr>';
                            echo '<td class="col-md-2">' . $row->courseName . '</td>';
                            echo '<td class="col-md-1">' . $row->courseSlope . '</td>';
                            echo '<td class="col-md-1">' . $row->courseRating . '</td>';
                            echo '<td class="col-md-1 centered">' . $row->courseDefault . '</td>';
                            echo '<td class="col-md-1">';
                                echo '<a class="btn btn-default col-md-12" href="' . base_url("index.php/course/edit/".$row->courseID) . '">Edit</a>';
                            echo '</td>';
                            echo '<td class="col-md-1">';
                                echo '<a class="btn btn-default col-md-12" href="' . base_url("index.php/course/delete/".$row->courseID) . '">Delete</a>';
                            echo'</td>';
                        echo '</tr>';
                    echo '</tbody>';
                echo '</table>';
            echo '</div>';
        }
        ?>
    </div>
</div>