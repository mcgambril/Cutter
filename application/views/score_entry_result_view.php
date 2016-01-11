<!--
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 7/28/2015
 * Time: 9:24 PM
 */
 -->

<?php
    if ($tempScoresError == TRUE) {
        echo'
        <div class="text-center">
            <h1>Success!</h1>
            <br>
            <h2>The scores were entered into the database.</h2>
        </div>
        <br>
        ';
    }
    else {
        echo'
            <div class="text-center">
                <h1>Success!</h1>
                <br>
                <h2>The following scores were successfully entered into the database:  </h2>
            </div>
            <br>
        ';

        foreach ($getTempScoresQuery as $row) {
            echo '<div class="row">
                <div class="col-md-12">
                    <p class="col-md-5"></p>
                    <table class="col-md-4 noPadLeft">
                        <tbody>
                            <tr>
                                <td class="col-md-3 resultDataPad">Player Name....</td>
                                <td class="col-md-9 resultDataPad">' . $row->tempPlayerName . '</td>
                            </tr>
                            <tr>
                                <td class="col-md-3 resultDataPad">Date..................</td>
                                <td class="col-md-9 resultDataPad">' . $row->tempDate . '</td>
                            </tr>
                            <tr>
                                <td class="col-md-3 resultDataPad">Course..............</td>
                                <td class="col-md-9 resultDataPad">' . $row->tempCourseName . '</td>
                            </tr>
                            <tr>
                                <td class="col-md-3 resultDataPad">Score................</td>
                                <td class="col-md-9 resultDataPad">' . $row->tempScore . '</td>
                            </tr>
                            <tr>
                                <td class="col-md-3 resultDataPad">Differential........</td>
                                <td class="col-md-9 resultDataPad">' . $row->tempDifferential . '</td>
                            </tr>
                            <tr>
                                <td class="col-md-3 resultDataPad">Time.................</td>
                                <td class="col-md-9 resultDataPad">' . $row->tempTime . '</td>
                            </tr>
                        </tbody>
                    </table>
                    <p class="col-md-3"></p>
                </div>
            </div>
            <br>';
        }
    }
?>

<div class="row">
    <div class="text-center col-md-12">
        <p class="col-md-5"><br><br><br></p>
        <a class="btn btn-default col-md-2" href="<?php echo base_url("index.php/score/chooseDate"); ?>">Score - Home</a>
        <p class="col-md-5"></p>
    </div>
    <br><br><br>
</div>
<br><br><br>

