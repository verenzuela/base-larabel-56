@extends('layouts.admin.master', 
  ['locale'       => '',
   'bodyCss'      => '',
   'title'        => 'OneFlexRoom | Users',
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

      @include('layouts.admin.sidebar', [ 'menuActive' => "tools_roles" ])

      <main class="app-main">

        <div class="wrapper">
          <div class="page">
            <div class="page-inner mt-2 pt-0 ">
              <header class="page-title-bar m-0 p-0 ">

                <!-- title and toolbar -->
                <div class="d-md-flex align-items-md-start">
                  <h1 class="page-title mr-sm-auto">{{ __('admin.roles.label') }}</h1>
                </div>
              
              </header>
              
              <div class="page-section">
                <div class="card card-fluid">
                  <div class="card-body">

                    <div class="col-md-6">
                      <div class="form-group">
                        <strong>{{ __('admin.label.name') }}:</strong>
                        {{ $role->display_name }}
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <strong>{{ __('admin.label.description') }}:</strong>
                        {{ $role->description }}
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <strong>{{ __('admin.roles.label.asignedPermission') }}:</strong>
                        @if(!empty($rolePermissions))
                          @foreach($rolePermissions as $v)
                            <label class="badge badge-primary">{{ $v->display_name }}</label>
                          @endforeach
                        @endif
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