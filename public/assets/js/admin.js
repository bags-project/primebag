//  ============================= Menu burger simplifié en admin =============================

function function_menu() {
  var x = document.getElementById("admin-topnavbar");
  if (x.className === "admin-navbar")
  {
    x.className += " responsive"; // Ajout de la class responsive en version mobile. Voir fichier css correspondant
  }
  else
  {
    x.className = "admin-navbar";
  }
}


//  ============================= Message progressif =============================

var message = document.querySelector(".progressive").innerHTML; // Utilisez class="afficher" sur du texte pour appliquer cet effet

document.querySelector(".progressive").innerHTML = ""; // On vide la div qui contient le mot.

for (let i=0; i<message.length; i++)
{
  setTimeout(function(){
    document.querySelector(".progressive").innerHTML += message[i]; // A chaque tour, affiche à l'index i
  }, 15*i);
}