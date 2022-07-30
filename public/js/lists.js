
function escapeHtml(text) {
  var map = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#039;'
  };

  return text.replace(/[&<>"']/g, function(m) { return map[m]; });
}

function formatMoney(number, decPlaces, decSep, thouSep) {
  decPlaces = isNaN(decPlaces = Math.abs(decPlaces)) ? 2 : decPlaces,
  decSep = typeof decSep === "undefined" ? "." : decSep;
  thouSep = typeof thouSep === "undefined" ? "," : thouSep;
  var sign = number < 0 ? "-" : "";
  var i = String(parseInt(number = Math.abs(Number(number) || 0).toFixed(decPlaces)));
  var j = (j = i.length) > 3 ? j % 3 : 0;

  return sign +
    (j ? i.substr(0, j) + thouSep : "") +
    i.substr(j).replace(/(\decSep{3})(?=\decSep)/g, "$1" + thouSep) +
    (decPlaces ? decSep + Math.abs(number - i).toFixed(decPlaces).slice(2) : "");
}


$(document).ready(function(){
/*DOM READY*/
  $(window).click(function() {
    $('#country_id_list').fadeOut();
    $('#state_id_list').fadeOut();
    $('#city_id_list').fadeOut();
    $('#category_id_list').fadeOut(); 
    $('#customer_id_list').fadeOut(); 
    $('#prod_attribute_id_list').fadeOut();    
  });

  /* COUTRY LIST */
  //$('#country_id_name').focus(function(){ 
  $('#country_id_name').on('focus keyup', function(e) {
    let query = $(this).val();
    let _token = $('input[name="_token"]').val();
    $.ajax({
      url:"/autocomplete/fetchCountries",
      method:"POST",
      data:{query:query, _token:_token},
      success:function(data){
        $('#country_id_list').fadeIn();  
        $('#country_id_list').html(data);
      }
    });
  }).focusout(function() {
    //$('#country_id_list').fadeOut();
  });
  /* END COUTRY LIST */


  /* STATE LIST */
  $('#state_id_name').on('focus keyup', function(e) {
    let query = $(this).val();
    let countryId = '';

    if($("#country_id").length){ countryId = $('#country_id').val(); }
    
    let _token = $('input[name="_token"]').val();
    $.ajax({
      url:"/autocomplete/fetchStates",
      method:"POST",
      data:{query:query, _token:_token, countryId:countryId },
      success:function(data){
        $('#state_id_list').fadeIn();  
        $('#state_id_list').html(data);
      }
    });
  }).focusout(function() {
    //$('#state_id_list').fadeOut();
  });
  /* END STATE LIST */


  /* CITY LIST */
  $('#city_id_name').on('focus keyup', function(e) {
    let query = $(this).val();
    let stateId ='';

    if($("#state_id").length){ stateId = $('#state_id').val(); };
    
    let _token = $('input[name="_token"]').val();

    $.ajax({
      url:"/autocomplete/fetchCities",
      method:"POST",
      data:{query:query, _token:_token, stateId:stateId },
      success:function(data){
        $('#city_id_list').fadeIn();  
        $('#city_id_list').html(data);
      }
    });
  }).focusout(function() {
    //$('#city_id_list').fadeOut();
  });
  /* END CITY LIST */



  /* PARENT CATEGORY LIST */
  $('#category_id_name').on('focus keyup', function(e) {
    let query = $(this).val();
    let categoryId ='';

    if($("#category_id").length){ categoryId = $('#category_id').val(); };
    
    let _token = $('input[name="_token"]').val();

    $.ajax({
      url:"/autocomplete/fetchCategories",
      method:"POST",
      data:{query:query, _token:_token, categoryId:categoryId },
      success:function(data){
        $('#category_id_list').fadeIn();  
        $('#category_id_list').html(data);
      }
    });
  }).focusout(function() {
    //$('#category_id_list').fadeOut();
  });
  /* END CITY LIST */



  /* CUSTOMERS LIST */
  $('#customer_id_name').on('focus keyup', function(e) {
    let query = $(this).val();
    let customerId ='';

    if($("#customer_id").length){ customerId = $('#customer_id').val(); };
    
    let _token = $('input[name="_token"]').val();

    $.ajax({
      url:"/autocomplete/fetchCustomers",
      method:"POST",
      data:{query:query, _token:_token, customerId:customerId },
      success:function(data){
        $('#customer_id_list').fadeIn();  
        $('#customer_id_list').html(data);
      }
    });
  }).focusout(function() {
    //$('#customer_id_list').fadeOut();
  });
  /* END CUSTOMERS LIST */



  /* PRODUCTS LIST BY (prod_attribute_id) */
  $('#prod_attribute_id_name').on('focus keyup', function(e) {
    let query = $(this).val();
    let productAttributeId ='';

    if($("#prod_attribute_id").length){ productAttributeId = $('#prod_attribute_id').val(); };
    
    let _token = $('input[name="_token"]').val();

    $.ajax({
      url:"/autocomplete/fetchProducts",
      method:"POST",
      data:{query:query, _token:_token, productAttributeId:productAttributeId },
      success:function(data){
        $('#prod_attribute_id_list').fadeIn();  
        $('#prod_attribute_id_list').html(data);
      }
    });
  }).focusout(function() {
    //$('#prod_attribute_id_list').fadeOut();
  });
  /* END CUSTOMERS LIST */
  


  /* CLICK ON LI LIST ELEMENT */
  $(document).on('click', 'li', function(){  

    var liClass = $(this).attr("class");

    if($("#map").length){
      var photon = new photonApp();
      
      if( liClass == 'country' || liClass == 'state' || liClass == 'city' ){
        photon.search( $(this).text() );
      }
    };
    

    /* WHEN SELECT A COUNTRY IN THE LIST */
    if(liClass == 'country'){
      $('#country_id_name').val($(this).text());  
      $('#country_id').val($(this).val());  
      $('#country_id_list').fadeOut();    

      clearObjects('country_id');

      var zoom = 6;
    }


    /* WHEN SELECT A STATE IN THE LIST */
    if(liClass == 'state'){
      $('#state_id_name').val( $(this).text() );  
      $('#state_id').val( $(this).val() );  
      $('#state_id_list').fadeOut();

      clearObjects('state_id');

      if($("#country_id_name").length){
        $('#country_id').val( $(this).data("country-id") );  
        $('#country_id_name').val( $(this).data("country-name") );  
      }

      var zoom = 10;
    }


    /* WHEN SELECT A CITY IN THE LIST */
    if(liClass == 'city'){
      $('#city_id_name').val( $(this).text() );  
      $('#city_id').val( $(this).val() );  
      $('#city_id_list').fadeOut();
      
      clearObjects('city_id');

      if($("#country_id_name").length){
        $('#country_id').val( $(this).data("country-id") );  
        $('#country_id_name').val( $(this).data("country-name") );  
      }

      if($("#state_id_name").length){
        $('#state_id').val( $(this).data("state-id") );  
        $('#state_id_name').val( $(this).data("state-name") );  
      }

      var zoom = 13;
    }



    /* WHEN SELECT A PARENT CATEGORY IN THE LIST */
    if(liClass == 'category'){
      $('#category_id_name').val( $(this).text() );  
      $('#category_id').val( $(this).val() );  
      $('#category_id_list').fadeOut();
    }


    /* WHEN SELECT A CUSTOMER IN THE LIST */
    if(liClass == 'customer'){
      $("#customer_id_name").val( $(this).text() );  
      $("#customer_id").val( $(this).val() );  
      $("#customer_id_list").fadeOut();
    }



    /* WHEN SELECT A PRODUCTS BY (prod_attribute_id) IN THE LIST */
    if(liClass == 'prod-attribute'){
      //$("#prod_attribute_id_name").val( $(this).text() );  
    
      $('#prod_attribute_id_name').val( $(this).data("productSku") );  

      productName = $(this).data("productName");
      if($(this).data("productSize")){
        productName += ', size: '+$(this).data("productSize");  
      }

      if( $(this).closest('form').find('input[name="name"]').length ){
        $(this).closest('form').find('input[name="name"]').val( 
          productName
        );
      }

      if( $(this).closest('form').find('input[name="qty"]').length ){
        $(this).closest('form').find('input[name="qty"]').focus();
      }

      if( $(this).closest('form').find('input[name="unit-price"]').length ){
        $(this).closest('form').find('input[name="unit-price"]').val( formatMoney( $(this).data("productPrice") )  );
      }

      $("#prod_attribute_id").val( $(this).val() );  
      $("#prod_attribute_id_list").fadeOut();
    }
    /* END WHEN SELECT A PRODUCTS BY (prod_attribute_id) IN THE LIST */


    


    if($("#map").length){
      if( liClass == 'country' || liClass == 'state' || liClass == 'city' ){
        setTimeout(function() { 
          if( $('#latitude').val() != '' && $('#longitude').val()!='' ){
            map.setNewLocation( myMap, myMarker, $('#latitude').val(), $('#longitude').val(), zoom );  
          }            
        }, 2000);
      }
    };


  });
  /* END CLICK LI */



  var clearObjects = function( $currentObjectId ) {
    
    if( $("#state_id").length && $currentObjectId != "state_id" ){
      $('#state_id_name').val('');  
      $('#state_id').val('');  
      $('#state_id_list').fadeOut();
    }

    if( $("#city_id").length && $currentObjectId != "city_id" ){
      $('#city_id_name').val('');  
      $('#city_id').val('');  
      $('#city_id_list').fadeOut();
    }

    

  }

})
