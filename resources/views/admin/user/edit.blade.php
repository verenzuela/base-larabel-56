@extends('layouts.admin.master', 
  ['locale'       => '',
   'bodyCss'      => '',
   'title'        => strtoupper(env('APP_NAME')).' | '.__('admin.user.label.update'),
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
            <div class="page-inner mt-2 pt-0 ">
              <header class="page-title-bar m-0 p-0 ">

                <!-- title and toolbar -->
                <div class="d-md-flex align-items-md-start">
                  <h1 class="page-title mr-sm-auto">{{ __('admin.user.label.update') }}</h1>
                </div>
              
              </header>
              
              <div class="page-section">
                <div class="card card-fluid">
                  <div class="card-body">
                    
                    {!!Form::model($user,['method'=>'PATCH', 'files'=>true, 'route'=>['users.update',$user->id]])!!}
                    
                    @include('commons.admin.success-errors-views', [ 'errors' => $errors, 'session'=>(isset($session)) ? $session : '' ])

                    <fieldset>

                      <div class="row">
                        <div class="col-md-6">
                          {!! $render->inpunt('name', $user->name, $errors, true) !!}
                        </div>
                        <div class="col-md-6">
                          @if (Auth::user()->hasRole("root"))
                            {!! $render->inpunt('email', $user->email, $errors, true) !!}
                          @else
                            <div class="form-label-group">
                              <b>{{ __('admin.label.email') }}:</b> {{ $user->email }}
                            </div>
                          @endif
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          {!! $render->password('password', false, $errors, false ) !!}
                        </div>
                        <div class="col-md-6">
                          {!! $render->select('role_id', ( count($user->roles) != 0 ) ? $user->roles[0]->id : 0, $rolesList, $errors, $required=true, $customLabel=false ) !!}
                        </div>
                      </div>

                      <!-- Button -->
                      @permission('user-edit')
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