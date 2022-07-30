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

  @section('content')
    <div class="app">

      @include('layouts.admin.navbar')

      @include('layouts.admin.sidebar', [ 'menuActive' => "settings" ])

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
                    
                    @include('commons.admin.success-errors-views', [ 'errors' => $errors, 'session'=>(isset($session)) ? $session : '' ])

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </main>

    </div>
  @endsection