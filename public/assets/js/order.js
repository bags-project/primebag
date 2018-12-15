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

        $('#order-order_section_1').css({
            "display": "none"
        })
        
        $('#order_section_2').show();
        $('#order_section_3').hide();
        $('#order_section_4').hide();
        // $('#order_section_5').hide();
    });

    $('#button2').on('click', function () {

        $('#order-container').css({
            "display": "block"
        })    
        $('#order_section_2').hide();
        $('#order_section_3').show();
        $('#order_section_4').hide();
        // $('#order_section_5').hide();
    });

    $('#button3').on('click', function () {

        $('#order-container').css({
            "display": "block"
        })
        $('#order_section_2').hide();
        $('#order_section_3').hide();
        $('#order_section_4').show();
        // $('#order_section_5').hide();
    });

    // $('#button4').on('click', function () {

    //     $('#order-container').css({
    //         "display": "block"
    //     })
    //     $('#order_section_2').hide();
    //     $('#order_section_3').hide();
    //     $('#order_section_4').hide();
    //     $('#order_section_5').show();
    // });

});