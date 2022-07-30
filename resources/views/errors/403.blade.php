@extends('layouts.admin.master', 
  ['locale'       => '',
   'bodyCss'      => '',
   'title'        => '403 | '.__('error.unauthorized'),
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
      @include('layouts.admin.sidebar', [ 'menuActive' => 'dashboard' ])
      
      <main class="app-main">
        <div class="wrapper">
          <div class="empty-state">
            <div class="empty-state-container">
              <h3 class="state-header"> Error 403. </h3>
              <p class="state-description lead text-muted">
               {{ $exception->getMessage() }}
              </p>
            </div>
          </div>
        </div>
      </main>

    </div>
  @endsection