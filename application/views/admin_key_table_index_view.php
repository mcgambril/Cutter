<!--
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 3/5/2023
 * Time: 9:27 PM
 */
 -->

 
<div class="container">
    <div class="page-header">
        <h1>Admin - <small>Key Table</small></h1>
    </div>
    <div class="row">
    <div class="col-md-4 col-xs-12 bottomPadTiny">
        <a class="btn btn-default col-md-6 col-xs-6" href="<?php echo base_url("admin/addKeyRecord"); ?>">Add a record</a>
    </div>
    </div>
    
    <div class="row">
        <div class="col-xs-12 col-md-8">
            <div class="panel panel-default">
                <div class="table-responsive">  
                    <table class ="table table-condensed table-bordered">
                        <thead>
                            <tr>
                                <th class="homeCourseHeader centered col-xs-2 col-md-2">Symbol</th>
                                <th class="homeCourseHeader centered col-xs-3 col-md-3">Description</th>
                                <th class="homeCourseHeader centered col-xs-2 col-md-2">Display Toggle</th>
                                <th class="homeCourseHeader centered col-xs-2 col-md-2">Display Order</th>
                                <th class="homeCourseHeader centered col-xs-3 col-md-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($getBetsQuery == 'empty') {
                                echo '';
                            }
                            else {
                                foreach($getBetsQuery as $row) {
                                    echo '<tr>'
                                    . '     <td class="centered col-xs-2 col-md-2">' . $row->symbol . '</td>'
                                    . '     <td class="centered col-xs-3 col-md-3">' . $row->description . '</td>'
                                    . '     <td class="centered col-xs-2 col-md-2">' . $row->displayToggle . '</td>'
                                    . '     <td class="centered col-xs-2 col-md-2">' . $row->displayOrder . '</td>'
                                    . '     <td class="col-xs-3">'
                                    . '         <a class="btn btn-default col-xs-12 col-md-6 smallFont" href="' . base_url("admin/editKeyRecord/") . '">Edit</a>'
                                    . '         <a class="btn btn-default col-xs-12 col-md-6 smallFont" href="' . base_url("admin/deleteKeyRecord/") . '">Delete</a>'
                                    . '     </td>'
                                    . '   </tr>';
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