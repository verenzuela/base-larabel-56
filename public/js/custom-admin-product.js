//$( document ).ready(function() {

  statusSpinner = function (spinner, action){
    if(action == 'show'){
      $('#'+spinner).removeClass('d-none');
    }else{
      $('#'+spinner).addClass('d-none');
    }
  };


  statusMessage = function (container, message, cssClass){
    $('#'+container).html(message);
    $('#'+container).addClass('badge-'+cssClass);
    $('#'+container).removeClass('d-none');

    setTimeout(function () { 
      $('#'+container).addClass('d-none');
      $('#'+container).removeClass('badge-'+cssClass);
      $('#'+container).html('');
    }, 2000);
  };


  selectAttributesOnProductVariations = function( productVariationId ){
    let containerProductVariation = $("#container-product-variation-content-"+productVariationId);
    let containerAttributes = $("#container-product-variation-select-attributes-"+productVariationId);
    let btnAddAttributes = $("#btn_add_attributes_product_variation_"+productVariationId);
    let btnHideAttributes = $("#btn_hide_attributes_product_variation_"+productVariationId);

    if( containerAttributes.hasClass( "d-none" ) ){
      containerAttributes.removeClass("d-none");
      containerProductVariation.addClass("d-none");
      btnAddAttributes.addClass("d-none");
      btnHideAttributes.removeClass("d-none");

    }else{
      containerAttributes.addClass("d-none");
      containerProductVariation.removeClass("d-none");
      btnAddAttributes.removeClass("d-none");
      btnHideAttributes.addClass("d-none");

    }
  }


  removeAttributeFromProduct = function (productAttributeId, token) {
    let form = new FormData();
    form.append('_token', token);

    $.ajax({          
      url: `/product/attribute/remove/${productAttributeId}`,
      type: "POST",
      data: form,
      contentType:false,
      cache: false,
      processData: false,
      success: function(response){
        if(response.status){
          $('#checkBoxAttributeList').append(response.data.html.checkbox);
          $('#'+response.data.selectRemoved).remove();
        }
      },
      error: function(XMLHttpRequest, status, errorThrown) { 
        alert(XMLHttpRequest, status, errorThrown); 
      } 
    });
  }



  removeAttributeFromProductVariantion = function (productVariationAttributeId, token) {
    let form = new FormData();
    form.append('_token', token);

    $.ajax({          
      url: `/product/variation/attribute/remove/${productVariationAttributeId}`,
      type: "POST",
      data: form,
      contentType:false,
      cache: false,
      processData: false,
      success: function(response){
        if(response.status){
          $('#checkBoxAttributeList_'+response.data.productVariationId).append(response.data.html.checkbox);
          $('#'+response.data.selectRemoved).remove();
        }
      },
      error: function(XMLHttpRequest, status, errorThrown) { 
        alert(XMLHttpRequest, status, errorThrown); 
      } 
    });
  }



  selectAttribute = function (elementId, attributeId, token, productVariationId=false) {
    if( productVariationId == '') productVariationId=false;

    if( $('#'+elementId).is(':checked') ){
      return getAttributeSelect(attributeId, token, productVariationId);
    }else{
      containerId = (!productVariationId) ? '#div_attribute_'+attributeId : '#div_attribute_'+productVariationId;

      if(productVariationId=='product_variation_create')
        containerId = '#div_attribute_'+attributeId+'_';

      $(containerId).remove();
    };
  };

	getAttributeSelect = function (attributeId, token, productVariationId=false) {
    let form = new FormData();
    form.append('_token', token);

    if(productVariationId) form.append('productVariationId', productVariationId);

    $.ajax({          
      url: `/attribute/${attributeId}/get/select/element`,
      type: "POST",
      data: form,
      contentType:false,
      cache: false,
      processData: false,
      success: function(response){
        if(response.status){
          containerId = (!productVariationId) ? '#attributes_list' : '#product_variation_attributes_list_'+productVariationId;
          $(containerId).append(response.data.html.select);
        }
      },
      error: function(XMLHttpRequest, status, errorThrown) { 
        alert(XMLHttpRequest, status, errorThrown); 
      } 
    });
  };




  selectAttributeOnProductVariation = function (elementId, attributeId, token) {
    if( $('#'+elementId).is(':checked') ){
      return getAttributeSelect(attributeId, token);
    }else{
      $('#div_attribute_'+attributeId).remove();
    }
  };



  $('#enable_variations').change(function () {
    if( $(this).is(':checked') ){
      var r = confirm("Está seguro que desea habilitar las variaciones de productos.? \n Los atributos del producto actual serán convertidos en una variación, usted podra editar las caracteristicas luego.");
      if (r == true) {
        var submit = $(this).closest('form').find(':submit');
        submit.click();
      } else {
        $(this).prop('checked', false);
      } 
    }else{
      var r = confirm("Está seguro que desea deshabilitar las variaciones de productos.? \n Todas las variaciones de productos serán desactivadas, podrá verlas cuando habilite esta opción de nuevo.");
      if (r == true) {
        var submit = $(this).closest('form').find(':submit');
        submit.click();
      } else {
        $(this).prop('checked', true);
      }
    }
  });


  $('#limit_stock').change(function () {
    if( $(this).is(':checked') ){
      $('#stock_status').attr('disabled', true);
      $('#container-stock').removeClass('d-none');
      $('#stock').val(1);
    }else{
      $('#stock_status').attr('disabled', false);
      $('#container-stock').addClass('d-none');
      $('#stock').val('');
    }
  });



//});