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
                        </tbody>
                    </table>
                </div>
                <br><br>
            ';
        }
    ?>
</div>

<div class="row">
    <div class="text-center col-md-12">
        <div class="col-md-4"></div>
        <a class="btn btn-default col-md-2" href="<?php echo base_url("index.php/course/index") ?>">Course - Home</a>
        <a class="btn btn-default col-md-2" href="<?php echo base_url("index.php/course/edit/" . $courseID)?>">Back to Course Edit</a>
        <div class="col-md-4"></div>
    </div>
</div>
<br><br><br>