//$( document ).ready(function() {

  setNewOrderStatus = function (orderId, newStatus, message) {
    let form = new FormData();
    form.append('_token', $('input[name="_token"]').val() );

    if( confirm(message) ){
      $.ajax({          
        url: `/order/${orderId}/move/status/${newStatus}`,
        type: "POST",
        data: form,
        contentType:false,
        cache: false,
        processData: false,
        success: function(response){
          if( response.status ){
            location.reload();
          }else{
            alert( response.message ); 
          };
        },
        error: function(XMLHttpRequest, status, errorThrown) { 
          console.log(XMLHttpRequest.responseJSON, status, errorThrown);
          if( XMLHttpRequest.responseJSON.hasOwnProperty('message') ){
            alert(XMLHttpRequest.responseJSON.message)
          }          
        } 
      });
    }
    
    /*
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
    */

  }


//});