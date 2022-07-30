@extends('layouts.admin.master', 
  ['locale'       => '',
   'bodyCss'      => '',
   'title'        => strtoupper(env('APP_NAME')) . ' | ' . __('admin.label.landig_page_config.create'),
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

      @include('layouts.admin.sidebar', [ 'menuActive' => "landing_page_" . $sectionName ])

      <main class="app-main">

        <div class="wrapper">
          <div class="page">
            <div class="page-inner mt-2 pt-0 ">
              <header class="page-title-bar m-0 p-0 ">
                <!-- title and toolbar -->
                <div class="d-md-flex align-items-md-start">
                  <h1 class="page-title mr-sm-auto">{{ __('admin.landing_page.' . $sectionName . '.create') }}</h1>
                </div>
              </header>
              
              <div class="page-section">
                <div class="card card-fluid">
                  <div class="card-body">

                    {!!Form::open( array('url'=>route('landing-page-config.store', ['sectionName' => $sectionName] ),'method'=>'POST','autocomplete'=>'off', 'files'=>true) )!!}


                      @include('commons.admin.success-errors-views', [ 'errors' => $errors, 'session'=>(isset($session)) ? $session : '' ])

                      <input type="hidden" id="section_name" name="section_name" value="{{ $sectionName }}">
                      
                      <fieldset>
                        <div class="row">
                          <div class="col-md-8">
                            {!! $render->inpunt('name', $value=false, $errors, $required=true, $customLabel='descriptive_name') !!}
                          </div>
                        </div>

                        @if( $settings->use_title )
                        <div class="row">
                          <div class="col-md-8">
                            {!! $render->inpunt('title', $value=false, $errors, $required=false, $customLabel=false) !!}
                          </div>
                        </div>
                        @endif

                        @if( $settings->use_content )
                        <div class="row">
                          <div class="col-md-8">
                            {!! $render->textArea('content', false, 5, $errors, $customLabel=false, $required=false) !!}
                          </div>
                        </div>
                        @endif

                        @if( $settings->use_heading_1 )
                        <div class="row">
                          <div class="col-md-8">
                            {!! $render->inpunt('heading_1', $value=false, $errors, $required=false, $customLabel=false) !!}
                          </div>
                        </div>
                        @endif

                        @if( $settings->use_heading_2 )
                        <div class="row">
                          <div class="col-md-8">
                            {!! $render->inpunt('heading_2', $value=false, $errors, $required=false, $customLabel=false) !!}
                          </div>
                        </div>
                        @endif

                        @if( $settings->use_url_name )
                        <div class="row">
                          <div class="col-md-8">
                            {!! $render->inpunt('url_name', $value=false, $errors, $required=false, $customLabel=false) !!}
                          </div>
                        </div>
                        @endif

                        @if( $settings->use_url_target )
                        <div class="row">
                          <div class="col-md-8">
                            {!! $render->inpunt('url_target', $value=false, $errors, $required=false, $customLabel=false) !!}
                          </div>
                        </div>
                        @endif
                        

                        @if( $settings->use_image )
                        <div class="row">
                          <div class="col-md-6">
                            {!! $render->fileInput('img_url', $settings->required_image ) !!}
                          </div>
                        </div>
                        @endif


                        <!-- Button -->
                        @permission('landing_page-create')
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