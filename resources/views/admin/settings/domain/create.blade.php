@extends('layouts.admin.master', 
  ['locale'       => '',
   'bodyCss'      => '',
   'title'        => strtoupper(env('APP_NAME')).' | ',
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

  @section('content')
    <div class="app">

      @include('layouts.admin.navbar')

      @include('layouts.admin.sidebar', [ 'menuActive' => "domains" ])

      <main class="app-main">

        <div class="wrapper">
          <div class="page">
            <div class="page-inner mt-2 pt-0 ">
              <header class="page-title-bar m-0 p-0 ">

                
                <!-- title and toolbar -->
                <div class="d-md-flex align-items-md-start">
                  <h1 class="page-title mr-sm-auto">{{ __('admin.domain.label') }}</h1>
                </div>
              
              </header>
              
              <div class="page-section">
                <div class="card card-fluid">

                  <div class="card-body">
                    
                    {!!Form::open( array('url'=>route('domains.store'),'method'=>'POST','autocomplete'=>'off') )!!}
                    
                      @include('commons.admin.success-errors-views', [ 'errors' => $errors, 'session'=>(isset($session)) ? $session : '' ])

                      <fieldset>
                        
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <div class="form-label-group">
                                <input type="hidden" id="domain_id" name="domain_id" value="{{ $domain->id }}">
                                <input type="text" class="form-control {{ $errors->has('domain_id') ? 'is-invalid' : '' }}" value="{{ $domain->name }}" readonly="readonly"> 
                                <label for="name">{{ __('admin.label.domain') }}</label>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-6">
                            {!! $render->inpunt('adm_url', false, $errors ) !!}
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            {!! $render->inpunt('web_url', false, $errors ) !!}
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            {!! $render->inpunt('api_url', false, $errors ) !!}
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            {!! $render->inpunt('post_stay_url_questionnaire', false, $errors ) !!}
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            {!! $render->inpunt('booking_confirm_url_questionnaire', false, $errors ) !!}
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            {!! $render->inpunt('booking_cancel_url_questionnaire', false, $errors ) !!}
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            {!! $render->inpunt('randomize_homepage_slideshow', false, $errors ) !!}
                          </div>
                        </div>

                        <!-- Button -->
                        @permission('web-config-create')
                        <div class="publisher-actions">
                          <div class="publisher-tools mr-auto"></div>
                          <button type="submit" class="btn btn-primary">{{ __('admin.create') }}</button>
                        </div>
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