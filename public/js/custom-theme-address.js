$( document ).ready(function() {
  
  /***********************************************************/
  /*
  /*
  /*
  /***********************************************************/
  clearObjects = function( currentObjectId, preNameInput='' ) {
    if( $("#"+preNameInput+"state_id").length && currentObjectId != preNameInput+"state_id" ){
      $("#"+preNameInput+"state").val('');
      $("#"+preNameInput+"state_id").val('');
      $("#"+preNameInput+"state_list").fadeOut();
    }

    if( $("#"+preNameInput+"city_id").length && currentObjectId != preNameInput+"city_id" ){
      $("#"+preNameInput+"city").val('');
      $("#"+preNameInput+"city_id").val('');
      $("#"+preNameInput+"city_list").fadeOut();
    }
  }


  /***********************************************************/
  /*
  /*
  /*
  /***********************************************************/
  selectItemOnAutoCompleteList = function (item) {
    clearObjects( item.data("input-id"), item.data("input-pre-name") );

    $('#'+item.data("input-id")).val(item.text()).trigger('change');//set item name on input
    $('#'+item.data("input-id")+'_id').val(item.val()).trigger('change');//set item id on input
    $('#'+item.data("input-id")+'_list').fadeOut();//hide item list result search
    

    if( item.hasClass("state-list-"+item.data("input-id")) ){
      if($('#'+item.data("input-pre-name")+'country').length){
        $('#'+item.data("input-pre-name")+'country_id').val( item.data("country-id") ).trigger('change');
        $('#'+item.data("input-pre-name")+'country').val( item.data("country-name") ).trigger('change');
      }
    }

    if( item.hasClass("city-list-"+item.data("input-id")) ){
      if($('#'+item.data("input-pre-name")+'country').length){
        $('#'+item.data("input-pre-name")+'country_id').val( item.data("country-id") ).trigger('change');
        $('#'+item.data("input-pre-name")+'country').val( item.data("country-name") ).trigger('change');
      }

      if($('#'+item.data("input-pre-name")+'state').length){
        $('#'+item.data("input-pre-name")+'state_id').val( item.data("state-id") ).trigger('change');
        $('#'+item.data("input-pre-name")+'state').val( item.data("state-name") ).trigger('change');
      }
    }
  };


  /***********************************************************/
  /*
  /*
  /*
  /***********************************************************/
  listPlacesInput = function (input, type, preNameInput='') {
    let query = input.val();
    let inputId = input.attr('id');
    
    if(type=='country'){
      var url = "/autocomplete/web/fetchCountries";  
      var data = { query:query, inputId:inputId, preNameInput:preNameInput, _token:$('input[name="_token"]').val() };
    }

    if(type=='state'){
      let countryId = '';
      if($("#"+preNameInput+'country_id').length) countryId = $("#"+preNameInput+'country_id').val();
      var url = "/autocomplete/web/fetchStates";
      var data = { query:query, inputId:inputId, preNameInput:preNameInput, countryId:countryId, _token:$('input[name="_token"]').val() };
    }

    if(type=='city'){
      let stateId = '';
      if($("#"+preNameInput+'state_id').length) stateId = $("#"+preNameInput+'state_id').val();
      var url = "/autocomplete/web/fetchCities";
      var data = { query:query, inputId:inputId, preNameInput:preNameInput, stateId:stateId, _token:$('input[name="_token"]').val() };
    }

    $.ajax({
      url:url,
      method:"POST",
      data:data,
      success:function(data){
        $('#'+inputId+'_list').fadeIn();
        $('#'+inputId+'_list').html(data);
      }
    });
  };

});