  // =============================================
  // API geo.api.gouv.fr. Retrieve City by ZipCode
  // =============================================
  
  "use strict"
  
  //Variables
  var zipcode; 
  var source;
  var lists = {};
  var elmt_list = $('#user_register_city');
  
  $("#btSubmit").on('click', function(){
  
  zipcode = $('#user_register_zipCode').val();
  source = 'https://geo.api.gouv.fr/communes?codePostal='+zipcode+'&fields=nom&format=json&geometry=centre';
  
  });
  
  $(document).ready(function(){
  
      // ====================
      // Retrieve lists
      // ====================
  
      $("#btSubmit").on('click', function(){
          // Retrieve the List of city
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
          // error: function(){
          //     alert( "Oops an error has occurred." );
          // }
      });
  }
  
      // ====================
      // Insert in DOM
      // ====================
  
  function show_list(response) {
  
      elmt_list.empty();
      lists = response;
      
      $.each(lists, function (indexInArray, list) { 
          var elmt_option = $('<option>');
          elmt_option.attr("value", list.nom );
          elmt_option.html(list.nom);
          elmt_list.append(elmt_option); 
      
      });
      
  }
