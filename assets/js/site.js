/**
 * Created by Matthew on 12/29/2015.
 */

//Score Edit by Date:  Highlight a row as red when Delete? checkbox is selected
$(function () {
    $("input[type='checkbox'].delete_box").change(function(){
        if($(this).is(":checked")){
            //add functionality to make the rest of the inputs on this row disabled and cleared
            //makes a row become red when the delete check box is checked
            $(this).parents('tr').addClass("delete");
        }else{
            //add functionality to make the rest of the inputs on this row enabled
            //returns a row to normal background when the delete checkbox is unchecked
            $(this).parents('tr').removeClass("delete");
        }
    });
});

//http://stackoverflow.com/questions/7741722/change-color-of-selected-option-only
//https://learn.jquery.com/using-jquery-core/faq/how-do-i-test-whether-an-element-has-a-particular-class/
//http://stackoverflow.com/questions/196684/jquery-get-specific-option-tag-text
$(function () {
    $('.editCourse').change(function () {
        //var $tempCourse = $("option[class='selected']").name();
        //var $tempCourse = $(this).find('option:selected').name;
        //var $length = $tempCourse.length;
        //var $endPos = $length - 1;
        //var $replacementText = $tempCourse.substring(0, $endPos);
        //$('option[class="selected"]').text($replacementText);
        /*if ($(this).find('option').hasClass('selected') == true) {
            var $tempCourse = $("option[class='selected']").name;
        }*/

        $(this).find('option').removeClass('selected');
        $(this).find('option:selected').addClass("selected");
        //var $selectedName = $("option:selected").name;
        //$(this).find('option:selected').text($selectedName.concat('*'));

        /*if( $("#selectedEx").is(".selectedCourse")) {
            $("#selectedEx").css('font-weight', 'bold');
        }*/

    }).trigger('change');
});

//datepicker widget initializer
$(function() {
    $( "#datepicker" ).datepicker({
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat:  'mm/dd/yy', /*'yy-mm-dd*/
        showAnim: 'slideDown'
    });
});

//jquery dialog box widget initializer:  used for handicap update confirmation
//http://api.jqueryui.com/dialog/#option-autoOpen
$(function dialogHandicapUpdate(){
    //http://stackoverflow.com/questions/503093/how-can-i-make-a-redirect-page-using-jquery
    var $currentPath = window.location.pathname;            //  /handicap/update
    var $length = $currentPath.length;
    var $endPos = $length - 6;                              //take 6 away b/c 'update' is 6 letters;
    var $tempPath = $currentPath.substring(0,$endPos);      //  /handicap/  b/c endPos is where the string cuts off...will not take that letter
    var $newPath = $tempPath.concat("submitUpdate");        //  /handicap/submitUpdate
    $( "#dialog-confirm").dialog({
        height: 200,
        draggable: true,
        modal: true,
        resizable: true,
        autoOpen: false,
        buttons: {
            "Continue": function() {
                window.location.href=$newPath;
            },
            Cancel: function() {
                $( this).dialog( "close" );
            }
        }
    });
    $( "#openHandicapDialog").click(function() {
        $( "#dialog-confirm").dialog( "open" );
    })
});




