function open_nav() {
  document.getElementById("mon_sidenav").style.width = "250px";
}

function close_nav() {
  document.getElementById("mon_sidenav").style.width = "0";
}


// =============================================
// API geo.api.gouv.fr. Retrieve City by ZipCode
// =============================================

//Variables
var zipcode; 
var source;
var lists = {};
var elmt_list = $('.list');

$(document).ready(function(){

    // ====================
    // Retrieve lists
    // ====================

    $(".zipcode").blur(function(){

        zipcode = $('.zipcode').val();
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
function setLists(url) {
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


// // Modal de confirmation de suppression d'un article du panier
// var remFromCartButton = $('#btnRemFromCart');

// remFromCartButton.on("click", function(){
//     // code ci-dessous ne fonctionne pas, bonne route injectée mais interprétée en string dans l'url
//     // récup de l'id de l'article à supprimer
//     //var idArticleToRemove = remFromCartButton.val();


//     //var remLink = "{{ path('cart_remove', {'id': " + idArticleToRemove + "})|escape('js') }}";
//     // marche pas non plus; impossible d'accéder à à le route en saisie d'url côté client :
//     //var remLink = "primebag/public/index.php/cart/remove?id=" + idArticleToRemove;

//     // envoie de l'id dans la route du lien du bouton de confirmation du modal
//     //$('#linkCartRemove').attr("href", remLink );
    
//     $('#confirmModal').show(1000);
//     //alert(remLink);
// })
