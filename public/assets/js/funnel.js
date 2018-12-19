////////////////////////////////////////////////////////////////
// Fonction de changement du DOM (frais et dates livraison) sur le tunnel d'achat
//$(document).ready(function () {


    // var shippingTaxes = 5;

    // var today = new Date();
    // var in1days = new Date();
    // var in3days = new Date();
    // var in8days = new Date();

    // in1days.setDate(today.getDate()+1);
    // in3days.setDate(today.getDate()+3);
    // in8days.setDate(today.getDate()+8);

    // $('input:radio[name=modeLivraison]').change(function () {
    //     //alert("function on change");
        
    //     if ($("input[name='modeLivraison']:checked").val() == 5) {
    //         // alert("colissimo checked");
    //         $('#shippingTaxes').text("Frais : 5€");
    //         $('#deliveryDate').text("Date de livraison estimée : entre le " + in3days.toLocaleDateString() + 
    //                                 " et le " + in8days.toLocaleDateString() );
    //         $('#spanDelivery').text("5€");
    //         // $("#spanDelivery").attr("value", 5);
    //         var shippingTaxes = 5;                                       
    //     }else if ($("input[name='modeLivraison']:checked").val() == 10) {
    //         // alert("chronopost checked");
    //         $('#shippingTaxes').text("Frais : 10€");
    //         $('#deliveryDate').text("Date de livraison estimée : entre le " + in1days.toLocaleDateString() + 
    //                                 " et le " + in3days.toLocaleDateString() );            
    //         $('#spanDelivery').text("10€");
    //         // $("#spanDelivery").attr("value", 10);
    //         var shippingTaxes = 10;                                                     
    //     }else {
    //         // alert("retraint magasin checked");
    //         $('#shippingTaxes').text("Frais : aucun");
    //         $('#deliveryDate').text("Vous pouvez retirer votre commande à tout moment. (Consultez les horaires d'ouvertures de la boutique)");              
    //         $('#spanDelivery').text("Aucun");
    //         // $("#spanDelivery").attr("value", 0);
    //         var shippingTaxes = 0;              
    //     }
    //     console.log(shippingTaxes);
    //     return shippingTaxes;
    // });
//});






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
