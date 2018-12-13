function open_nav() {
  document.getElementById("mon_sidenav").style.width = "250px";
}

function close_nav() {
  document.getElementById("mon_sidenav").style.width = "0";
}



// function function_menu() {
//   var x = document.getElementById("top_navbar");
//   if (x.className === "navbar")
//   {
//     x.className += " responsive"; // Ajout de la class responsive en version mobile
//   }
//   else
//   {
//     x.className = "navbar";
//   }
// }


// =============================================
// API geo.api.gouv.fr. Retrieve City by ZipCode
// =============================================

//Variables
var zipcode; 
var source;
var lists = {};
var elmt_list = $('#user_register_city');



$(document).ready(function(){

    // ====================
    // Retrieve lists
    // ====================

    $("#user_register_zipcode").blur(function(){

        zipcode = $('#user_register_zipcode').val();
        source = 'https://geo.api.gouv.fr/communes?codePostal='+zipcode+'&fields=nom&format=json&geometry=centre';
        setLists(source);   
        
        
        
    });
        

});

/**
 * SetLists
 * 
 * @param (string) url address of Lists 
 * @return (object) lists
 */
function setLists(url) 
{
    // AJAX request
    $.ajax({
        method: "GET",
        url: url,
        dataType: "json",
        success: show_list,
        error: function(){
            alert( "Oops an error has occurred." );
        }
    });
}


// La partie DOM LIST
function show_list(response) {

    elmt_list.empty();
    lists = response;
    
    $.each(lists, function (indexInArray, list) { 
        

        var elmt_option = $('<option>');
    
        elmt_option.attr("value", list.nom );
        elmt_option.text(list.nom);
        elmt_list.append(elmt_option); 
    
    });
    
}


