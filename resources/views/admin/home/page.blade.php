@extends('layouts.admin.master', 
  ['locale'       => '',
   'bodyCss'      => '',
   'title'        => strtoupper(env('APP_NAME')).' | '.__('admin.label.dashboard'),
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
        @include('commons.admin.success-errors-views', [ 'errors' => $errors, 'session'=>(isset($session)) ? $session : '' ])

        <div class="wrapper">
          <div class="page">
            <div class="page-inner mt-2 pt-0 ">
              
              

            </div>
          </div>
        </div>

      </main>
    </div>

  @endsection