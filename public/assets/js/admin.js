function function_menu() {
  var x = document.getElementById("admin-topnavbar");
  if (x.className === "admin-navbar")
  {
    x.className += " responsive"; // Ajout de la class responsive en version mobile
  }
  else
  {
    x.className = "admin-navbar";
  }
}