@extends('layouts.admin.master', 
  ['locale'       => '',
   'bodyCss'      => '',
   'title'        => strtoupper(env('APP_NAME')).' | '.__('admin.webSettings.label'),
   'ogTitle'      => '',
   'ogLocale'     => '',
   'ogDescription'=> '',
   'ogUrl'        => '',
   'ogSiteName'   => '',
   'autor'        => '',
   'description'  => '',
   'canonicalUrl' => '',
  ]
) 
  @push('scripts')
    <script type="text/javascript">
      
      setEmailSending = function (status) {
        let form = new FormData();
        form.append('_token', $('input[name="_token"]').val() );
        
        $.ajax({          
          url: `/web/settings/email/sending/${status}`,
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

      };

      $('#enable_email_sending').change(function () {
        if( $(this).is(':checked') ){
          var r = confirm("{{ __('admin.label.sure_to_enable_email_sending') }}");
          if (r == true) {
            setEmailSending(1);
          } else {
            $(this).prop('checked', false);
          } 
        }else{
          var r = confirm("{{ __('admin.label.sure_to_disable_email_sending') }}");
          if (r == true) {
            setEmailSending(0);
          } else {
            $(this).prop('checked', true);
          }
        }
      });

    </script>
  @endpush

  @section('content')
    <div class="app">

      @include('layouts.admin.navbar')

      @include('layouts.admin.sidebar', [ 'menuActive' => "settings_web" ])

      <main class="app-main">

        <div class="wrapper">
          <div class="page">
            <div class="page-inner mt-2 pt-0 ">
              <header class="page-title-bar m-0 p-0 ">

                
                <!-- title and toolbar -->
                <div class="d-md-flex align-items-md-start">
                  <h1 class="page-title mr-sm-auto">{{ __('admin.webSettings.label') }}</h1>
                </div>
              
              </header>
              
              <div class="page-section">
                <div class="card card-fluid">

                  <div class="card-body">
                    
                    {!!Form::model($webSetting,['method'=>'PATCH', 'files'=>true, 'route'=>['web-settings.update',$webSetting->id]])!!}
                    
                    @include('commons.admin.success-errors-views', [ 'errors' => $errors, 'session'=>(isset($session)) ? $session : '' ])

                    <fieldset>

                      <input type="hidden" id="typeSettings" name="typeSettings" value="web">

                      <div class="row">
                        <div class="col-md-6">
                          <label><strong>{{ __('admin.label.store_name') }}</strong></label>: <span>{!! $domain->description !!}</span>
                          {{-- !! $render->inpunt('store_name', $domain->description, $errors, false, false, false) !! --}}
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <label><strong>{{ __('admin.label.adm_email') }}</strong></label>: <span>{!! $webSetting->adm_email !!}</span>
                          {{-- !! $render->inpunt('adm_email', $webSetting->adm_email, $errors, false, false, false) !! --}}
                        </div>
                      </div>

                      <!--div class="row">
                        <div class="col-md-6">
                          {!! $render->inpunt('name', $domain->name, $errors, false, false, false) !!}
                        </div>
                      </div-->

                      <div class="row">
                        <div class="col-md-6">
                          <label><strong>{{ __('admin.label.adm_url') }}</strong></label>: <span><a href="http://{{ $webSetting->adm_url }}" target="_blank">{!! $webSetting->adm_url !!}</a></span>
                          {{-- !! $render->inpunt('adm_url', $webSetting->adm_url, $errors, false, false, false) !! --}}
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <label><strong>{{ __('admin.label.web_url') }}</strong></label>: <span><a href="http://{{ $webSetting->web_url }}" target="_blank">{!! $webSetting->web_url !!}</a></span>
                          {{-- !! $render->inpunt('web_url', $webSetting->web_url, $errors, false, false, false) !! --}}
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          {{-- !! $render->inpunt('api_url', $webSetting->api_url, $errors, false, false, false) !! --}}
                        </div>
                      </div>

                      <hr>

                      <div class="row">
                        <div class="col-md-6">
                          {!! $render->checkbox('enable_email_sending', $webSetting->enable_email_sending, $customLabel=false, $formGroupDiv=true, $classOnFirstDiv='m-0 p-0', $classOnInput='') !!}
                        </div>
                      </div>

                      <hr>

                      <!--div class="row">
                        <div class="col-md-3">
                          <div class="form-group">
                            <div class="form-label-group">
                              <select class="custom-select" id="fls1" required="">
                                @foreach( $locales as $key => $locale )
                                  <option {{ ($locale['regional'] == $webSetting->locale) ? 'selected' : ''  }} value="{{ $key }}">
                                    {{ $locale['native'] }}
                                  </option>
                                @endforeach
                              </select> 
                              <label for="fls1">{{ __('admin.label.default_languaje') }}</label>
                            </div>
                          </div>
                        </div>
                      </div-->

                      <!--div class="row">
                        <div class="col-md-6">
                          {!! $render->switch('randomize_homepage_slideshow', $webSetting->randomize_homepage_slideshow) !!}
                        </div>
                      </div-->

                      <!-- Button -->
                      @permission('web-config-edit')
                      <!--div class="publisher-actions">
                        <div class="publisher-tools mr-auto"></div>
                        <button type="submit" class="btn btn-primary">{{ __('admin.update') }}</button>
                      </div-->
                      @endpermission

                    </fieldset>
                    {!!Form::close()!!}

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </main>

    </div>
  @endsection