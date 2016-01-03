/**
 * Created by Matthew on 12/29/2015.
 */

//Score Edit by Date:  Highlight a row as red when Delete? checkbox is selected
$(function () {
    $("input[type='checkbox'].delete_box").change(function(){
        if($(this).is(":checked")){
            //add functionality to make the rest of the inputs on this row disabled and cleared
            $(this).parents('tr').addClass("delete");
        }else{
            //add functionality to make the rest of the inputs on this row enabled
            $(this).parents('tr').removeClass("delete");
        }
    });
});

$('.viewScoresBtn').click(function(){
    var $this = $(this);
    $this.toggleClass('viewScoresBtn');
    if($this.hasClass('viewScoresBtn')){
        $this.text('Expand Scores');
    } else {
        $this.text('Collapse Scores');
    }
});

$(function() {
    $( "#datepicker" ).datepicker({
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat:  'yy-mm-dd',
        showAnim: 'slideDown'
    });
});




