@extends('layouts.admin.master', 
  ['locale'       => '',
   'bodyCss'      => '',
   'title'        => strtoupper(env('APP_NAME')).' | '.__('admin.customers.label.update'),
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

      @include('layouts.admin.sidebar', [ 'menuActive' => "users_front" ])

      <main class="app-main">

        <div class="wrapper">
          <div class="page">
            <div class="page-inner mt-2 pt-0 ">
              <header class="page-title-bar m-0 p-0 ">

                <!-- title and toolbar -->
                <div class="d-md-flex align-items-md-start">
                  <h1 class="page-title mr-sm-auto">{{ __('admin.customers.label.update') }}</h1>
                </div>
              
              </header>
              
              <div class="page-section">
                <div class="card card-fluid">
                  <div class="card-body">
                    
                    {!!Form::model($user,['method'=>'PATCH', 'files'=>true, 'route'=>['users.update',$user->id]])!!}
                    
                    @include('commons.admin.success-errors-views', [ 'errors' => $errors, 'session'=>(isset($session)) ? $session : '' ])

                    <fieldset>

                      <input type="hidden" id="type_user" name="type_user" value="frontend">

                      <div class="row">
                        <div class="col-md-4">
                          {!! $render->inpunt('firstname', $user->firstname, $errors, true) !!}
                        </div>
                        <div class="col-md-4">
                          {!! $render->inpunt('lastname', $user->lastname, $errors) !!}
                        </div>
                        <div class="col-md-4">
                          {!! $render->inpunt('email', $user->email, $errors, true) !!}
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-4">
                          {!! $render->inpunt('phone', $user->phone, $errors) !!}
                        </div>
                        <div class="col-md-4">
                          {!! $render->inpunt('address', $user->address, $errors) !!}
                        </div>
                        <div class="col-md-4">
                          {!! $render->inpunt('zip_code', $user->zip_code, $errors) !!}
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-4">
                          {!! $render->inpunt('country', $user->country, $errors) !!}
                        </div>                          
                        <div class="col-md-4">
                          {!! $render->inpunt('country_code', $user->country_code, $errors) !!}
                        </div>
                        <div class="col-md-4">
                          {!! $render->inpunt('city', $user->city, $errors) !!}
                        </div>
                      </div>

                      @if (Auth::user()->hasRole(['root', 'admin']))
                      <div class="row">
                        <div class="col-md-4">
                          {!! $render->password('password', false, $errors) !!}
                        </div>
                        <div class="col-md-4">
                          {!! $render->select('role_id', ( count($user->roles) != 0 ) ? $user->roles[0]->id : 0, $rolesList, $errors, true) !!}
                        </div>
                      </div>
                      @endif

                      <!-- Button -->
                      @permission('members-edit')
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