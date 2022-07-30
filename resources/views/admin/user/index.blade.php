@extends('layouts.admin.master', 
  ['locale'       => '',
   'bodyCss'      => '',
   'title'        => strtoupper(env('APP_NAME')).' | '.__('admin.label.users'),
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

                @permission('user-create')
                  <a href="{{ route('user.type.create', ['userType'=>'backend'] ) }}" class="btn btn-success btn-floated pt-3"><span class="fa fa-plus"></span></a>
                @endpermission

                <!-- title and toolbar -->
                <div class="d-md-flex align-items-md-start">
                  <h1 class="page-title mr-sm-auto">{{ __('admin.user.label') }}</h1>
                </div>
              
              </header>
              
              <div class="page-section">
                <div class="card card-fluid">

                  <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                        <a class="nav-link active show" data-toggle="tab" href="#tab1">{{ __('admin.all') }}</a>
                      </li>
                    </ul>
                  </div>

                  <div class="card-body">
                    
                    <div class="table-responsive">

                      <table class="table">
                      
                        <thead>
                          <tr>
                            <th>{{ __('admin.#') }}</th>
                            <th>{{ __('admin.label.name') }}</th>
                            <th>{{ __('admin.label.email') }}</th>
                            <th>{{ __('admin.label.createdAt') }}</th>
                            <th>{{ __('admin.user.label.rol') }}</th>
                            <th style="width:100px; min-width:100px;"> &nbsp; </th>
                          </tr>
                        </thead>

                        <tbody>

                          @if ( count($users) == 0)
                            <tr>
                              <td colspan="7" class="align-middle">
                                <p>{{ __('admin.noDataFound') }}</p>
                              </td>
                            </tr>
                          @else

                            @foreach ($users as $user)
                              
                              <tr>
                                <td class="align-middle">{{ $user->id }}</td>
                                <td class="align-middle">{{ $user->name }}</td>
                                <td class="align-middle">{{ $user->email }}</td>
                                <td class="align-middle">{{ $user->created_at->format('M d, Y h:i:s A') }}</td>
                                <td class="align-middle">{!! ( count($user->roles) != 0 ) ? __('admin.'.$user->roles[0]->name) : __('admin.label.noRoleSet') !!}</td>
                                <td class="align-middle text-right">
                                  <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="btn btn-sm btn-icon btn-secondary">
                                    <i class="fa fa-pencil-alt"></i>
                                    <span class="sr-only">{{ __('admin.edit') }}</span>
                                  </a>

                                  @permission('user-delete')
                                    <a href="#" data-target="#modal-delete-{{$user->id}}" data-toggle="modal" class="btn btn-sm btn-icon btn-secondary">
                                      <i class="far fa-trash-alt"></i>
                                      <span class="sr-only">{{ __('admin.remove') }}</span>
                                    </a>  
                                  @endpermission
                                  
                                </td>
                              </tr>

                              @include('commons.admin.modal-delete', [ 'routeName' => 'users.destroy', 'id'=>$user->id ])

                            @endforeach

                          @endif

                        </tbody>

                      </table>

                      {!! $users->links() !!}
                      
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