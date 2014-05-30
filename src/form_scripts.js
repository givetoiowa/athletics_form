/**
 * jQUery/JavaScript for Athletics Form
 * Author: Addison Benzshawel / UIF
 */

$(document).ready(function(){
    if( $('#chooseNo').is(':checked') ) {
        $("#corrections").show();
    }
});

$(document).on('change', "input[name='correctInfo']", function(){
    var bgi_id = $(this).val();
    if(bgi_id == "false"){
        $("#corrections").show();
    } else {
        $("#corrections").hide();
    }
});