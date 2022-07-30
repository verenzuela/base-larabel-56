$( document ).ready(function() {


  $("#drop-container").on('dragenter', function (e){
    e.preventDefault();
    $(this).css('border', '#39b311 2px dashed');
    $(this).css('background', '#f1ffef');
  });

  $("#drop-container").on('dragover', function (e){
    e.preventDefault();
  });

  $("#drop-container").on('drop', function (e){
    $(this).css('border', '#07c6f1 2px dashed');
    $(this).css('background', '#FFF');
    e.preventDefault();
    var image = e.originalEvent.dataTransfer.files;
    uploadProductImage(image);
  });

  $("#click_for_upload").on('click', function (e){
    $('#newImageByClick').trigger('click'); 
  }); 

  $('#newImageByClick').change(function(evt) {
    uploadProductImage( $(this)[0].files );
  });

    
  uploadProductImage = function (image, fromProductVariation=false) {
    $('#uploading-image-bar').removeClass('d-none');

    let formImage = new FormData();
    formImage.append('dropImage', image[0]);
    formImage.append('_token', $('input[name="_token"]').val() );
    if(fromProductVariation)
      formImage.append('fromProductVariationId', fromProductVariation);

    imageUpload(formImage);
  };


  imageUpload = function (formData) {
    $.ajax({
      url: `/product/${ $('#product-id').val() }/image/upload`,
      type: "POST",
      data: formData,
      contentType:false,
      cache: false,
      processData: false,
      success: function(response){
        if(response.status){

          $('#drop-container').append(response.data.htmlImage);
          $('#uploading-image-bar').addClass('d-none');

          let producVariation = response.data.product_variation;
          if( producVariation.hasOwnProperty('id') ){
            if( producVariation.image.deleted.hasOwnProperty('original') ){
              imageIdRemoved = response.data.product_variation.image.deleted.original.data.imageId;
              $('#imageWrap-'+imageIdRemoved).remove();
            }
            $('#imgProductVariationOnList-'+producVariation.id).attr("src", producVariation.image.html50);
            $('#imgProductVariationOnEdit-'+producVariation.id).attr("src", producVariation.image.html100);
            
            //hide spinner
            $("#imgProductVariationOnEdit-"+producVariation.id).removeClass('d-none');
            $("#imgSpinnerProductVariationOnEdit-"+producVariation.id).addClass('d-none');
          }

        }
      },
      error: function(XMLHttpRequest, status, errorThrown) { 
        if(XMLHttpRequest.responseJSON.message == "error_limit_images"){
          $('#uploading-image-bar').addClass('d-none');
          alert('{{ __("error.error_limit_images") }}')
        }; 
      }   
    });
  };


  imageDelete = function ( imageId, currentAssignedOnProductVariation ) {
    $('#uploading-image-bar').removeClass('d-none');
    let data = new FormData();
    data.append('_token', $('input[name="_token"]').val() );

    $.ajax({
      url: `/product/image/${imageId}/delete`,
      type: "POST",
      data: data,
      contentType:false,
      cache: false,
      processData: false,
      success: function(response){
        if(response.status){
          $('#imageWrap-'+response.data.imageId).fadeOut(300, function(){ $(this).remove();});
          
          if(currentAssignedOnProductVariation > 0 ){
            $('#imgProductVariationOnList-'+currentAssignedOnProductVariation).attr("src", response.data.imgBlankUrl50);
            $('#imgProductVariationOnEdit-'+currentAssignedOnProductVariation).attr("src", response.data.imgBlankUrl100);
          }

          $('#uploading-image-bar').addClass('d-none');
        };
      },
      error: function(XMLHttpRequest, status, errorThrown) { 
        $('#uploading-image-bar').addClass('d-none');
        alert(XMLHttpRequest, status, errorThrown);
      }
    });
  };


  setImageOnVariation = function ( element, currentAssignedOnProductVariation ){
    $('#uploading-image-bar').removeClass('d-none');
    
    let imgUrl50            = element.children(":selected").attr("data-img-url-50");
    let imgUrl100           = element.children(":selected").attr("data-img-url-100");
    let productId           = element.children(":selected").attr("data-product-id");
    let productVariationId  = element.children(":selected").attr("data-product-variation-id");
    let productImageId      = element.children(":selected").attr("data-product-image-id");

    let storageOn = localStorage.getItem('product:'+productId+'productVariation:'+productVariationId)
    if( storageOn && productImageId!=storageOn ) $('#selectProductImage-'+storageOn).val("null");

    let form = new FormData();
    form.append('_token', $('input[name="_token"]').val() );
    $.ajax({
      url: `/image/${productImageId}/on/product-variation/${productVariationId}`,
      type: "POST",
      data: form,
      contentType:false,
      cache: false,
      processData: false,
      success: function(response){
        if(response.status){
          if(currentAssignedOnProductVariation > 0 ){
            $('#imgProductVariationOnList-'+currentAssignedOnProductVariation).attr("src", response.data.imgBlankUrl50);
            $('#imgProductVariationOnEdit-'+currentAssignedOnProductVariation).attr("src", response.data.imgBlankUrl100);
          }
          
          localStorage.setItem('product:'+productId+'productVariation:'+productVariationId, productImageId);
          $('#imgProductVariationOnList-'+productVariationId).attr("src", imgUrl50);
          $('#imgProductVariationOnEdit-'+productVariationId).attr("src", imgUrl100);
          $('#imageWrap-'+response.data.productImageId).remove();
          $('#drop-container').append(response.data.htmlImage);
          $('#uploading-image-bar').addClass('d-none');
        };
      },
      error: function(XMLHttpRequest, status, errorThrown) { 
        $('#uploading-image-bar').addClass('d-none');
        alert(XMLHttpRequest, status, errorThrown);
      }
    });
  };


});