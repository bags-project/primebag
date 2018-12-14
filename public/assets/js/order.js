

$(document).ready(function () {
    
    // $("#header1").click(function () {

    //     $("#section_one").show();
    //     $("#section_two").hide();
    // });
    // $("#header2").click(function () {
    
    //     $("#section_two").show();
    //     $("#section_one").hide();
    
    // });

    $(document).ready(function() {
        $('#button1').on('click', function() {
            $('#section_one').show();
            $('#section_two').hide();
        });
    
        $('#button2').on('click', function() {
            $('#section_one').hide();
            $('#section_two').show();
        });    
    });

});
