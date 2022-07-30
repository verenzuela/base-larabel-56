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
                    
                    {!!Form::model($domain,['method'=>'PATCH', 'files'=>true, 'route'=>['domains.update',$domain->id]])!!}
                    
                    @include('commons.admin.success-errors-views', [ 'errors' => $errors, 'session'=>(isset($session)) ? $session : '' ])

                    <fieldset>

                      <input type="hidden" id="countWebSettings" name="countWebSettings" value="{{ $countWebSettings }}">
 
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <div class="form-label-group">
                              <input type="text" class="form-control {{ $errors->has('domain_id') ? 'is-invalid' : '' }}" value="{{ $domain->name }}" readonly="readonly"> 
                              <label for="name">{{ __('admin.label.domain') }}</label>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          {!! $render->textArea('description', $domain->description, 3, $errors ) !!}
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-2">
                          {!! $render->inpunt('web_port', $domain->web_port, $errors ) !!}
                        </div>
                        <div class="col-md-2">
                          {!! $render->inpunt('ssl_port', $domain->ssl_port, $errors ) !!}
                        </div>
                        <div class="col-md-2">
                          {!! $render->switchWhitText('ssl', $domain->ssl ) !!}
                        </div>
                      </div>

                      <!-- Button -->
                      @permission('web-config-edit')
                      <div class="publisher-actions">
                        <div class="publisher-tools mr-auto"></div>
                        <button type="submit" class="btn btn-primary">{{ __('admin.update') }}</button>
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