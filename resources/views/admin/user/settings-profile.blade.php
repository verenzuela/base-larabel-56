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
                    
                    @include('admin.user.settings-sidebar', [ 'activeSide' => "profile" ])
                  
                  </div>
                  <div class="col-lg-8">
                    
                    <div class="card card-fluid">
                      <h6 class="card-header">{{ __('admin.label.profile') }}</h6>
                      <div class="card-body">
                        
                        <form method="POST" action="{{ route('user.profile.update', [ 'user' => $user->id ]) }}" accept-charset="UTF-8" enctype="multipart/form-data">
                          {!! csrf_field() !!}

                          <div class="media mb-3">
                            <div class="user-avatar user-avatar-xl fileinput-button">
                              <div class="fileinput-button-label"> Change photo </div>
                              <img src="{{ ($user->img_url) ? $user->img_url : asset('images/user.jpeg') }}" alt=""> 
                              <input type="file" id="img_url" name="img_url">
                            </div>
                            
                            <div class="media-body pl-3">
                              <h3 class="card-title"> Public avatar </h3>
                              <h6 class="card-subtitle text-muted"> Click the current avatar to change your photo. </h6>
                              <p class="card-text">
                                <small>JPG, GIF or PNG 400x400, &lt; 2 MB.</small>
                              </p>
                              <div id="progress-avatar" class="progress progress-xs fade">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>
                          </div>

                          <div class="form-row">
                            <label for="input02" class="col-md-3">{{ __('admin.label.firstname') }}:</label>
                            <div class="col-md-9 mb-3">
                              <input type="text" class="form-control" id="firstname" name="firstname" value="{{ ($user->firstname) ? $user->firstname : $nameArr[0]  }}">
                            </div>
                          </div>

                          <div class="form-row">
                            <label for="input02" class="col-md-3">{{ __('admin.label.lastname') }}:</label>
                            <div class="col-md-9 mb-3">
                              <input type="text" class="form-control" id="lastname" name="lastname" value="{{ ($user->lastname) ? $user->lastname : $nameArr[1]  }}">
                            </div>
                          </div>

                          <div class="form-row">
                            <label for="input02" class="col-md-3">{{ __('admin.label.phone') }}:</label>
                            <div class="col-md-9 mb-3">
                              <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}">
                            </div>
                          </div>

                          <!--div class="form-row">
                            <label for="input02" class="col-md-3">{{ __('admin.profile.label.position') }}:</label>
                            <div class="col-md-9 mb-3">
                              <input type="text" class="form-control" id="input02" value="{{ $user->lastname }}">
                            </div>
                          </div>
                          
                          <div class="form-row">
                            <label for="input02" class="col-md-3">{{ __('admin.profile.label.role') }}:</label>
                            <div class="col-md-9 mb-3">
                              {!! ($user->roles) ? $user->roles->first()->display_name : __('adminlabel.noRoleSet') !!}
                            </div>
                          </div-->
                          
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