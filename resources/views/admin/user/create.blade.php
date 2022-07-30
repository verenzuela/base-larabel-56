@extends('layouts.admin.master', 
  ['locale'       => '',
   'bodyCss'      => '',
   'title'        => strtoupper(env('APP_NAME')).' | '.__('admin.user.label.create'),
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
                  <h1 class="page-title mr-sm-auto">{{ __('admin.user.label.create') }}</h1>
                </div>
              </header>
              
              <div class="page-section">
                <div class="card card-fluid">
                  <div class="card-body">
                    
                    {!!Form::open( array('url'=>route('users.store'),'method'=>'POST','autocomplete'=>'off') )!!}
                    
                      @include('commons.admin.success-errors-views', [ 'errors' => $errors, 'session'=>(isset($session)) ? $session : '' ])

                      <fieldset>
                        
                        <input type="hidden" id="type_user" name="type_user" value="backend">
                        
                        <div class="row">
                          <div class="col-md-6">
                            {!! $render->inpunt('name', $value=false, $errors, $required=true, $customLabel=false) !!}
                          </div>
                          <div class="col-md-6">
                            {!! $render->inpunt('email', $value=false, $errors, $required=true, $customLabel=false) !!}
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-6">

                            <div class="row">
                              <div class="col-6" >
                                {!! $render->switchWhitText('generate_password', $value=false, $customLabel='generate_and_send', $showLabel=true) !!}
                              </div>
                              <div class="col-6" >
                                {!! $render->password('password', $value=false, $errors, $required=false, $customLabel=false) !!}
                              </div>
                            </div>

                            
                          </div>
                          <div class="col-md-6">
                            {!! $render->select('role_id', false, $rolesList, $errors, $required=true, $customLabel=false ) !!}
                          </div>
                        </div>

                        <!-- Button -->
                        @permission('user-create')
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