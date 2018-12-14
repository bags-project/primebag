$('#order-container').css({
    "display": "none"
})

$(document).ready(function () {

    $('#order-container').css({
        "display": "none"
    })
    
    $('#button1').on('click', function () {
        $('#order-container').css({
            "display": "block"
        })
        $('#section_1').show();
        $('#section_2').hide();
        $('#section_3').hide();
        $('#section_4').hide();
    });

    $('#button2').on('click', function () {

        $('#order-container').css({
            "display": "block"
        })    
        $('#section_1').hide();
        $('#section_2').show();
        $('#section_3').hide();
        $('#section_4').hide();
    });

    $('#button3').on('click', function () {

        $('#order-container').css({
            "display": "block"
        })
        $('#section_1').hide();
        $('#section_2').hide();
        $('#section_3').show();
        $('#section_4').hide();
    });

    $('#button4').on('click', function () {

        $('#order-container').css({
            "display": "block"
        })
        $('#section_1').hide();
        $('#section_2').hide();
        $('#section_3').hide();
        $('#section_4').show();
    });

});