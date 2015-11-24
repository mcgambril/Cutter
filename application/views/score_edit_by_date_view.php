<!--
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 11/23/2015
 * Time: 1:53 PM
 */
 -->
<!--
    -Need to be able to view the full score info:  name, course, date, score, time, differential
    -should only be able to edit the score and the course; if anything else needs to be changed then they will just have to delete that record
     and create a new one with the proper data
    -there should be a delete option on this page as well just to make it easier-->

 <div class="container">
    <div class="page-header">
        <h1>Score - <small>Edit Scores for <?php echo $date ?></small></h1>
    </div>
     <?php echo validation_errors(); ?>

     <?php echo form_open('score/submitEditScore') ?>
     <?php echo '<p style="width:15%;">Date: <input type="text" value="' . $date . '" name="datepicker"  class="form-control" readonly></p>';?>
     <div class="panel panel-default">
         <!-- Default panel contents -->
         <div class="panel-heading">Existing Scores for <?php echo $date?></div>

         <div class="table-responsive">
             <table class ="table table-condensed table-bordered" style="border-collapse:collapse;">
                 <thead>
                 <tr>
                     <th class="col-md-1">Player</th>
                     <th class="col-md-1">Date</th>
                     <th class="col-md-1">Course</th>
                     <th class="col-md-1">New Course</th>
                     <th class="col-md-1">Score</th>
                     <th class="col-md-1">New Score</th>
                     <th class="col-md-1">Time</th>
                     <th class="col-md-1">Delete?</th>
                 </tr>
             </table>
         </div>

         <?php
             foreach($getFullScoreInfoByDate as $row) {
                 echo'<div class="table-responsive">';
                     echo '<table class ="table table-condensed table-bordered">';
                         echo '<thead>';
                         echo '</thead>';
                         echo '<tbody>';
                             echo '<tr>';
                                 echo '<td class="col-md-1">' . $row->playerName . '</td>';
                                 echo '<td class="col-md-1">' . $row->scoreDate . '</td>';
                                 echo '<td class="col-md-1">' . $row->courseName . '</td>';
                                 echo '<td class="col-md-1">';
                                 echo '<select class="form-control" id="pick-course" name="course">';
                                     foreach($getCoursesQuery as $r) {
                                         echo '<option value="' . $r->courseID . '">' . $r->courseName . '</option>';
                                     }
                                 echo '</select></td>';
                                 echo '<td class="col-md-1">' . $row->scoreScore . '</td>';
                                 echo '<td class="col-md-1">';
                                    echo '<input type="text" class="col-md-12" name="' . $row->playerID . '-new-score"  id="' . $row->playerID . '-new-score" ' . $row->playerID . 'score">';
                                 echo '</td>';
                                 if ($row->scoreTime == 0) {
                                     echo '<td class="col-md-1">AM</td>';
                                 }
                                 else {
                                     echo '<td class="col-md-1">PM</td>';
                                 }
                                 echo '<td class="col-md-1">';
                                    echo 'Delete? <input type="checkbox" id="' . $row->playerID . '-delete"/>';
                                    //change the delete buttons to a delete check box and maybe highlight something red if checked just to be sure
                                 echo '</td>';
                             echo '</tr>';
                         echo '</tbody>';
                     echo '</table>';
                 echo '</div>';
             }
         ?>
     </div>
     <div class="text-center">
         <input type="submit" class="btn btn-default" value="Enter Scores" name="submit">
         <a class="btn btn-default" href="<?php echo base_url("index.php/score/chooseEditDate"); ?>">Back</a>
     </div>
 </div>
 </div>
