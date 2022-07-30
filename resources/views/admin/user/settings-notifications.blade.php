@extends('layouts.admin.master', 
  ['locale'       => '',
   'bodyCss'      => '',
   'title'        => strtoupper(env('APP_NAME')).' | '.__('admin.profile.label.notifications'),
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

      @include('layouts.admin.sidebar', [ 'menuActive' => "users" ])

      <main class="app-main">

        
        <div class="wrapper">
          <div class="page">
            
            @include('admin.user.settings-header', [ 'user' => $user ])
            
            @include('admin.user.settings-navs', [ 'activeNav' => "settings" ])

            <div class="page-inner">
              <div class="page-section">
                <div class="row">
                  <div class="col-lg-4">
                    
                    @include('admin.user.settings-sidebar', [ 'activeSide' => "notifications" ])
                  
                  </div>
                  <div class="col-lg-8">
                    
                                       

                  </div>
                </div>
              </div>
            </div>


        </div>
      </div>    


      </main>

    </div>
  @endsection