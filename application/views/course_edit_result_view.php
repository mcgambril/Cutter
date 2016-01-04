<!--
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 12/26/2015
 * Time: 10:36 PM
 */
 -->

<div class="text-center">
    <h1> <?php echo $title ?> </h1>
    <br>
    <h3> <?php echo $message1 ?> </h3>
    <br>
    <h3> <?php echo $message2 ?></h3>
    <br>
    <?php
        if ($title == 'Success!') {
            echo'
                <div class="resultDataTable">
                    <table class="resultDataTable">
                        <thead></thead>
                        <tbody>
                            <tr>
                                <td>Course Name......</td>
                                <td>' . $courseName . '</td>
                            </tr>
                            <tr>
                                <td>Course Slope......</td>
                                <td>' . $courseSlope . '</td>
                            </tr>
                            <tr>
                                <td>Course Rating.....</td>
                                <td>' . $courseRating . '</td>
                            </tr>
                            <tr>
                                <td>Home Course?...</td>
                                <td>' . $courseDefault . '</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <br><br>
            ';
        }
    ?>
</div>

<div class="text-center">
    <?php
        if ($noHomeCourse == TRUE) {
            echo'
                <p>You unset the home course.  Please set a new one:</p>
                <a class="btn btn-default" href="' . base_url("index.php/course/setHomeCourse") . '">Set New Home Course</a>
            ';
        }
        else {
            echo '
                <a class="btn btn-default" href="' . base_url("index.php/course/index") . '">Course - Home</a>
                <a class="btn btn-default" href="' . base_url("index.php/course/edit/" . $courseID) . '">Back to Course Edit</a>
            ';
        }
    ?>

</div>
<br><br><br>