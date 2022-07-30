@extends('layouts.admin.master', 
  ['locale'       => '',
   'bodyCss'      => '',
   'title'        => strtoupper(env('APP_NAME')) . ' | ' . __('admin.label.landig_page_config.edit'),
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

      @include('layouts.admin.sidebar', [ 'menuActive' => "landing_page_" . $landingConfig->section_name ])

      <main class="app-main">

        <div class="wrapper">
          <div class="page">
            <div class="page-inner mt-2 pt-0 ">
              <header class="page-title-bar m-0 p-0 ">
                <!-- title and toolbar -->
                <div class="d-md-flex align-items-md-start">
                  <h1 class="page-title mr-sm-auto">{{ __('admin.landing_page.' . $landingConfig->section_name . '.edit') }}</h1>
                </div>
              </header>
              
              <div class="page-section">
                <div class="card card-fluid">
                  <div class="card-body">

                    {!!Form::model($landingConfig,['method'=>'PATCH', 'files'=>true, 'route'=>['landing-page-config.update',$landingConfig->id]])!!}

                      @include('commons.admin.success-errors-views', [ 'errors' => $errors, 'session'=>(isset($session)) ? $session : '' ])

                      <input type="hidden" id="section_name" name="section_name" value="{{ $landingConfig->section_name }}">
                      
                      <fieldset>
                        <div class="row">
                          <div class="col-md-8">
                            {!! $render->inpunt('name', $landingConfig->name, $errors, $required=true, $customLabel='descriptive_name') !!}
                          </div>
                        </div>

                        @if( $settings->use_title )
                        <div class="row">
                          <div class="col-md-8">
                            {!! $render->inpunt('title', $landingConfig->title, $errors, $required=false, $customLabel=false) !!}
                          </div>
                        </div>
                        @endif

                        @if( $settings->use_content )
                        <div class="row">
                          <div class="col-md-8">
                            {!! $render->textArea('content', $landingConfig->content, 5, $errors, $customLabel=false, $required=false) !!}
                          </div>
                        </div>
                        @endif

                        @if( $settings->use_heading_1 )
                        <div class="row">
                          <div class="col-md-8">
                            {!! $render->inpunt('heading_1', $landingConfig->heading_1, $errors, $required=false, $customLabel=false) !!}
                          </div>
                        </div>
                        @endif

                        @if( $settings->use_heading_2 )
                        <div class="row">
                          <div class="col-md-8">
                            {!! $render->inpunt('heading_2', $landingConfig->heading_2, $errors, $required=false, $customLabel=false) !!}
                          </div>
                        </div>
                        @endif

                        @if( $settings->use_url_name )
                        <div class="row">
                          <div class="col-md-8">
                            {!! $render->inpunt('url_name', $landingConfig->url_name, $errors, $required=false, $customLabel=false) !!}
                          </div>
                        </div>
                        @endif

                        @if( $settings->use_url_target )
                        <div class="row">
                          <div class="col-md-8">
                            {!! $render->inpunt('url_target', $landingConfig->url_target, $errors, $required=false, $customLabel=false) !!}
                          </div>
                        </div>
                        @endif
                        

                        @if( $settings->use_image )

                          @forelse ($landingConfig->images as $image)
                            
                            <div class="row">
                              <div class="col-md-6">
                                <div class="row">
                                  <div class="col-md-3">
                                    <img class="img-thumbnail" src="{{ route('assets.image', ['w'=>'-', 'h'=>'-', 'imagePath'=> $image->img_url ]) }}" alt="">
                                  </div>
                                  <div class="col-md-9">
                                    {!! $render->fileInput('img_url', false) !!}
                                  </div>
                                </div>
                              </div>
                            </div>

                          @empty

                          @endforelse
                            
                        @endif

                        <!-- Button -->
                        @permission('landing_page-edit')
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