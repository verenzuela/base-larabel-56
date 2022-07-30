@extends('layouts.admin.master', $seo )

  @push('scripts')
    <script>
      $(document).ready(function(){

        $('#domain_name').keyup(function(){ 
          var query = $(this).val();
          if(query != ''){
            var _token = $('input[name="_token"]').val();
            $.ajax({
              url:"{{ route('autocomplete.fetchWebSettings') }}",
              method:"POST",
              data:{query:query, _token:_token},
              success:function(data){
                $('#domainList').fadeIn();  
                $('#domainList').html(data);
              }
            });
          }
        });

        $(document).on('click', 'li', function(){  
          $('#domain_name').val($(this).text());  
          $('#web_setting_id').val($(this).val());  
          $('#domainList').fadeOut();  
          
        });  

      });
    </script>
  @endpush

  @section('content')
    <div class="app">

      @include('layouts.admin.navbar')

      @include('layouts.admin.sidebar', [ 'menuActive' => $menuActive ])

      <main class="app-main">
        @component('components.admin.template-create',
          ['permission'   => $permission,
           'route'        => $route,
           'h1Title'      => __($h1Title.'.create'),
          ]
        )
          @section('layoutContent')
          <!--  START HTML CONTENT    -->

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <div class="form-label-group">
                    <label for="fls1">{{ __('admin.label.domain') }}</label>
                    <input type="text" name="domain_name" id="domain_name" class="form-control" value="{{ old('domain_name') }}" />
                    <input type="hidden" id="web_setting_id" name="web_setting_id" value="{{ (old('web_setting_id')) }}">
                    <div id="domainList"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                {!! $render->inpunt('name', false, $errors, true) !!}
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                {!! $render->inpunt('display_name', false, $errors, false) !!}
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-6">
                    {!! $render->inpunt('width', false, $errors, false, $customLabel='width_pixels', $editable=true, $classOnFirstDiv='', $classOnInput='text-right') !!}
                  </div>
                  <div class="col-md-6">
                    {!! $render->inpunt('height', false, $errors, false, $customLabel='height_pixels', $editable=true, $classOnFirstDiv='', $classOnInput='text-right') !!}
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                {!! $render->switch('status', false) !!}
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                {!! $render->fileInput('img_url', true) !!}
              </div>
            </div>

          <!--  END HTML CONTENT    -->
          @endsection

        @endcomponent
      </main>

    </div>
  @endsection
