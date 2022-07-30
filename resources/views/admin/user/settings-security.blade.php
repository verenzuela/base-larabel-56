@extends('layouts.admin.master', 
  ['locale'       => '',
   'bodyCss'      => '',
   'title'        => strtoupper(env('APP_NAME')).' | '.__('admin.profile.label.account'),
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

      @include('layouts.admin.sidebar', [ 'menuActive' => "users_system" ])

      <main class="app-main">

        
        <div class="wrapper">
          <div class="page">
            
            @include('admin.user.settings-header', [ 'user' => $user ])
            
            @include('admin.user.settings-navs', [ 'activeNav' => "settings" ])

            <div class="page-inner">
              <div class="page-section">
                <div class="row">
                  <div class="col-lg-4">
                    
                    @include('admin.user.settings-sidebar', [ 'activeSide' => "account" ])
                  
                  </div>
                  <div class="col-lg-8">
                    
                    <div class="card card-fluid">
                      <h6 class="card-header">{{ __('admin.label.changePassword') }}</h6>
                      <div class="card-body">
                        
                        @include('commons.admin.success-errors-views', [ 'errors' => $errors, 'session'=>(isset($session)) ? $session : '' ])

                        <form method="POST" action="{{ route('update.user.security', [ 'user' => $user->id ]) }}" accept-charset="UTF-8" enctype="multipart/form-data">
                          {!! csrf_field() !!}

                          <div class="form-group">
                            <label for="password">
                              {!! __('admin.label.password') !!}
                              <span class="badge badge-danger">{!! __('admin.required') !!}</span>
                            </label>
                            <input type="password" class="form-control" id="password" name="password" value="" required>
                          </div>

                          <div class="form-group">
                            <label for="password_confirmation">
                              {!! __('admin.label.confirm_password') !!}
                              <span class="badge badge-danger">{!! __('admin.required') !!}</span>
                            </label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" value="" required >
                          </div>

                          <hr>
                          <div class="form-actions">
                            <button type="submit" class="btn btn-primary ml-auto">{{ __('admin.update') }}</button>
                          </div>

                        </form>

                      </div>
                    </div>       

                  </div>
                </div>
              </div>
            </div>


        </div>
      </div>    


      </main>

    </div>
  @endsection