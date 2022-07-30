$( document ).ready(function() {


  openCartFromMessage = function (){
    //$('.bootbox').modal('toggle');
    $('.btn-cart-custom-style').click();
  }
  

  /**
  *
  *
  *
  */
  getData = function (element, dataKeys) {
    var jsonData = {};
    dataKeys.forEach(function(dataKey){
      jsonData[dataKey] = ( element.data(dataKey) ) ? element.data(dataKey) : '';
    });
    return jsonData;
  };
  

  /**
  *
  *
  *
  */
  qtyIsAnInteger = function(number) {
    return (number % 1 == 0) ? true : false;
  };
  

  /**
  *
  *
  *
  */
  toggleProductButtons = function (productId, action) {
		if(action == 'add'){
			let element = $('#btn_add_'+productId);
			let data = getData(element, ["toggleToBtnId", "qtyInputId"]);
			element.addClass('d-none');
			if( $('#'+data.qtyInputId).length ) $('#'+data.qtyInputId).addClass('d-none'); 
			if( $('#'+data.toggleToBtnId).length ) $('#'+data.toggleToBtnId).removeClass('d-none'); 
		}else if (action == 'remove'){
			let element = $('#btn_remove_'+productId);
			let data = getData(element, ["toggleToBtnId", "qtyInputId"]);
			element.addClass('d-none');
			if( $('#'+data.qtyInputId).length ) $('#'+data.qtyInputId).removeClass('d-none'); 
			if( $('#'+data.toggleToBtnId).length ) $('#'+data.toggleToBtnId).removeClass('d-none'); 
		};
		return;
	};
	

  /**
  *
  *
  *
  */
  removeFromCart = function (button) {
		let data = getData(button, [ "productId", "token" ]);

		let form = new FormData();
    form.append('_token', data.token);
    form.append('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));

    $.ajax({
      url: `/product/${data.productId}/cart/remove`,
      type: "POST",
      data: form,
      contentType:false,
      cache: false,
      processData: false,
      success: function(response){
        if(response.status){
          $('#count_in_cart').html(response.data.products_on_cart.html);
          toggleProductButtons(response.data.product.id, 'remove');
        }
      },
      error: function(XMLHttpRequest, status, errorThrown) {
        if(XMLHttpRequest.responseJSON.message == 'CSRF token mismatch.'){
          location.reload();
          return false;
        };

        if(XMLHttpRequest.responseJSON.message == 'error.product_not_found_in_cart'){
          location.reload();
          return false;
        }

        alert(XMLHttpRequest.responseJSON.message);
        
      } 
    });
	};


  /**
  *
  *
  *
  */
  addOnCart = function (button) {
    var data = getData( button, [ "productId", "toggleToBtnId", "qtyInputId", "token", "errorMessage", "msgContinueShoping", "msgModalShowCart" ] );
    let qty = 1;

    if( $('#'+data.qtyInputId).length ){
			qty = ( !$('#'+data.qtyInputId).val()  ) ? 1 : $('#'+data.qtyInputId).val();
		}

    if(!qtyIsAnInteger(qty) || qty.length == 0){
      alert('{{ __("error.quantity_is_not_valid") }}'); 
      return false; 
    }

    let attributesList = $('#product_'+data.productId+'_attribute_id_list').val();
    if(attributesList){
      let attributesId = attributesList.split(',');
      let attributeEmpty = false;
      let selectedAttributes = [];

      $.each(attributesId, function( index, value ) {
        let attrValue = $('#product_'+data.productId+'_attribute_'+value+'_selected').val();
        if( attrValue.length == 0 ){
          attributeEmpty = value;
          return false;
        }
      });

      if(attributeEmpty){
        let attributeInput = $('#product_'+data.productId+'_attribute_'+attributeEmpty+'_selected');
        let attributeEmptyData = getData( attributeInput, [ "attributeEmptyMessage"]);
        alert(attributeEmptyData.attributeEmptyMessage);
        return false;  
      }

      $.each(attributesId, function( index, value ) {
        let attrValue = $('#product_'+data.productId+'_attribute_'+value+'_selected').val();
        selectedAttributes[index] = 'attribute:'+value+'***'+'value:'+attrValue;
      });
    }


    let form = new FormData();
    form.append('_token', data.token);
    form.append('qty', qty);
    form.append('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));

    if(attributesList){
      if(attributesList.length > 0){
        form.append('selectedAttributes', selectedAttributes);
      }
    }

    var btnSpinner = document.getElementById('spinner_btn_add_'+data.productId);
    btnSpinner.classList.remove("d-none");
    button.prop('disabled', true);
    //$('#spinner_btn_add_'+button.productId).removeClass('d-none');

    $.ajax({
      url: `/product/${data.productId}/cart/add`,
      type: "POST",
      data: form,
      contentType:false,
      cache: false,
      processData: false,
      success: function(response){
        
        if(response.message == 'product_is_in_cart'){
          location.reload();
          return false;
        }

        if(response.status){
          $('#count_in_cart').html(response.data.products_on_cart.html);
          $('#spinner_btn_add_'+response.data.product.id).addClass('d-none');
          button.prop('disabled', false);

          openCartFromMessage();
          
          //bootbox.alert({
          //  message: data.msgModalShowCart,
          //  buttons: {
          //    ok: {
          //      label: data.msgContinueShoping,
          //    }
          //  }
          //})
          //toggleProductButtons(response.data.product.id, 'add');
        }
      },
      error: function(XMLHttpRequest, status, errorThrown) {
        if(XMLHttpRequest.responseJSON.message == 'CSRF token mismatch.'){
          location.reload();
          return false;
        };

        alert(XMLHttpRequest.responseJSON.message); 
      } 
    });
	};



  /**
  *
  *
  *
  */
  selectVariationAttribute = function(badge){
    let data = getData( badge, [ "productId", "attributeId", "attributeValueId", "token" ] );
    let inputAttributeSelected = "#product_"+data.productId+"_attribute_"+data.attributeId+"_selected";

    $('.badge-product-attribute-'+data.attributeId).removeClass('badge-secondary');
    badge.addClass('badge-secondary');
    $(inputAttributeSelected).val(data.attributeValueId);


    let attributes = $('#product_'+data.productId+'_attribute_id_list').val();
    let attributesId = attributes.split(',');
    selectedAttributes = [];
    $.each(attributesId, function( index, value ) {
      let attrValue = $('#product_'+data.productId+'_attribute_'+value+'_selected').val();
      selectedAttributes[index] = 'attribute:'+value+'***'+'value:'+attrValue;
    });
    
    let form = new FormData();
    form.append('_token', data.token);
    form.append('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
    
    $.ajax({
      url: `/product/${data.productId}/attributes/selected/${selectedAttributes}`,
      type: "POST",
      data: form,
      contentType:false,
      cache: false,
      processData: false,
      success: function(response){
        if(response.status){
          
          productId = response.data.result.product.id;
          stockStatus = response.data.result.product.stock_status;
          btn_text_add = response.data.result.product.btn_text_add;
          price = response.data.result.product.price;

          if(response.data.result.count==0){
            $('#product_'+productId+'_dinamic_stock').removeClass('text-success').addClass('text-danger');
            $('#btn_add_'+productId).removeClass('btn-primary').addClass('btn-secondary').prop("disabled", true);
            //$('#btn_add_'+productId).html(stockStatus);
            $('#text_btn_add_'+productId).html(stockStatus);
            $('#qty_'+productId).addClass('d-none');

          }else{
            $('#product_'+productId+'_dinamic_stock').removeClass('text-danger').addClass('text-success');
            $('#btn_add_'+productId).removeClass('btn-secondary').addClass('btn-primary').prop("disabled", false);
            //$('#btn_add_'+productId).html(btn_text_add);
            $('#text_btn_add_'+productId).html(btn_text_add);
            $('#qty_'+productId).removeClass('d-none');

          }
          
          if(price){
            $('#product_'+productId+'_dinamic_price_amount').html('Price: '+price);
          }
          $('#product_'+productId+'_dinamic_stock_amount').html(stockStatus);
        }
      },
      error: function(XMLHttpRequest, status, errorThrown) {
        if(XMLHttpRequest.responseJSON.message == 'CSRF token mismatch.'){
          location.reload();
          return false;
        };

        alert(XMLHttpRequest.responseJSON.message); 
      } 
    });
     
  }

});