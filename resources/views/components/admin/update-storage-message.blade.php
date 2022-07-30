
@push('styles')
  <style type="text/css">
    .overlay {
      height: 100%;
      width: 100%;
      display: none;
      position: fixed;
      z-index: 10000;
      top: 0;
      left: 0;
      background-color: rgb(0,0,0);
      background-color: rgba(0,0,0, 0.5);
    }

    .overlay-content {
      position: relative;
      top: 25%;
      width: 100%;
      text-align: center;
      margin-top: 30px;
    }

    .overlay a {
      padding: 8px;
      text-decoration: none;
      font-size: 36px;
      color: #818181;
      display: block;
      transition: 0.3s;
    }

    .overlay a:hover, .overlay a:focus {
      color: #f1f1f1;
    }

    .overlay .closebtn {
      position: absolute;
      top: 20px;
      right: 45px;
      font-size: 60px;
    }

    @media screen and (max-height: 450px) {
      .overlay a {font-size: 20px}
      .overlay .closebtn {
      font-size: 40px;
      top: 15px;
      right: 35px;
      }
    }
  </style>
@endpush


@push('scripts')
  <script type="text/javascript">
    function storeUpdateProcess() {
      this.status = function () { return request(); }
      
      function request(){
        var response = function () {
          var res = null;
          $.ajax({
            'async': false,
            'global': false,
            'url': `/api/update/store-process`,
            'type': "GET",
            'contentType': "application/json; charset=utf-8",
            'dataType': "json",
            'data': '',
            'success': function (data) {
              res = data;
            },
            'error': function(XMLHttpRequest, textStatus, errorThrown) { 
              setTimeout(function () { location.reload(); }, 6000);
            }
          });
          return res;
        }();

        if (response == null) return;
        
        if (typeof response.data !== 'undefined' && objectLength(response.data) > 0) {

          if ( response.data.store_base_code_status == 'outdated' ) {
            return
          } else if ( response.data.store_base_code_status == 'updating' ) {
            $('#updateAvailable').removeClass('d-block').addClass('d-none');
            $('#updatePending').removeClass('d-none').addClass('d-block');
            $('#updatingProgress').removeClass('d-block').addClass('d-none');
          } else if ( response.data.store_base_code_status == 'in-progress' ) {
            $('#updateAvailable').removeClass('d-block').addClass('d-none');
            $('#updatePending').removeClass('d-block').addClass('d-none');
            $('#updatingProgress').removeClass('d-none').addClass('d-block');
          } 

          if ( response.data.store_base_code_status == 'updated' ) {
            $('#updateAvailable').removeClass('d-block').addClass('d-none');
            $('#updatePending').removeClass('d-block').addClass('d-none');
            $('#updatingProgress').removeClass('d-block').addClass('d-none');
            return
          } else {
            setTimeout(function () { return request(); }, 6000);
          }
        }else{
          return
        }
      }

      function objectLength(obj) {
        var result = 0;
        for(var prop in obj) {
          if (obj.hasOwnProperty(prop)) {
            result++;
          }
        }
        return result;
      }
    }
    
    const baseStoreStatus = new storeUpdateProcess();
    baseStoreStatus.status();
    
  </script>
@endpush

<div id="updateAvailable" class="alert alert-warning {{ ($storeStatusStatus == 'outdated') ? 'd-block' : 'd-none' }} " role="alert">
  <span class="text-dark" >{{ __('admin.update.new-store-available') }}</span>
  <span data-toggle="tooltip" data-placement="bottom" data-original-title="{{ __('admin.update') }}" >
    <a href="#" data-target="#modal-store-update" data-toggle="modal" class="btn btn-xl btn-icon btn-secondary">
      <i class="fas fa-cloud-download-alt"></i>
      <span class="sr-only">{{ __('admin.Update') }}</span>
    </a>  
  </span>
</div>

<div id="overlayWhenUpdate" class="overlay {{ ($storeStatusStatus == 'updating' || $storeStatusStatus == 'in-progress') ? 'd-block' : 'd-none' }}  ">
  <div id="updatePending" class="alert alert-warning {{ ($storeStatusStatus == 'updating') ? 'd-block' : 'd-none' }} " role="alert">
    <span class="text-dark" >{{ __('admin.update.new-updating-pending') }}</span>
  </div>

  <div id="updatingProgress" class="progress {{ ($storeStatusStatus == 'in-progress') ? 'd-block' : 'd-none' }} " style="height: 25px;">
    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"><span style="font-size: 15px;">{{ __('admin.update.new-updating-in-progress') }}<span></div>
  </div>
</div>
  
<div class="modal fade" id="modal-store-update" tabindex="-1" role="dialog" aria-labelledby="updateStoreModalLabel" aria-hidden="true">
  {{Form::Open(array('route'=>array('base-store.update', 1), 'method'=>'post'))}}
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">{{ __('admin.update') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>{!! __('admin.msg.confirm.update.store', ['store_name'=>env('APP_NAME')]) !!}</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">{{ __('admin.close') }}</button>
        <button type="submit" class="btn btn-outline-primary">{{ __('admin.confirm') }}</button>
      </div>
    </div>
  </div>
  {{Form::Close()}}
</div>