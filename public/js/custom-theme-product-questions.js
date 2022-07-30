$( document ).ready(function() {
        
  validateAndAsk = function (isAuth=false) {

    if($("#product_body_question").val().trim().length < 1) {
      alert("Please Enter Your Question...");
      $("#product_body_question").focus();
      return; 
    }

    if(!isAuth){
      $("#modal-custom-login").modal();
      spinner = '<div class="text-center"><div class="load-spinner-div"><div id="spinner"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div></div></div>';
      $('.login-modal-body').html(spinner);
      $('.login-modal-body').load("/login/modal/show/1/questions");

      return false;
    }
    createQuestion();
  }


  createQuestion = function () {
    form = $('#form-question');
    form.submit(function(e){
        e.preventDefault();
    });

    $.ajax({          
      url: form.attr('action'),
      type: form.attr('method'),
      data: form.serialize(),
      success: function(response){
        if(response.status){
          $("#product_body_question").val('');
          location.reload();
        }
      },
      error: function(XMLHttpRequest, status, errorThrown) { 
        if(XMLHttpRequest.responseJSON.message == 'CSRF token mismatch.'){
          location.reload();
          return false;
        };
        
        console.log(XMLHttpRequest, status, errorThrown); 
      } 
    });
  };

});