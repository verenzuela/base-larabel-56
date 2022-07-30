@extends('layouts.admin.master', 
  ['locale'       => '',
   'bodyCss'      => '',
   'title'        => strtoupper(env('APP_NAME')).' | ',
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

      @include('layouts.admin.sidebar', [ 'menuActive' => "domains" ])

      <main class="app-main">

        <div class="wrapper">
          <div class="page">
            <div class="page-inner mt-2 pt-0 ">
              <header class="page-title-bar m-0 p-0 ">

                
                <!-- title and toolbar -->
                <div class="d-md-flex align-items-md-start">
                  <h1 class="page-title mr-sm-auto">{{ __('admin.domain.label') }}</h1>
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
                    
                    @include('commons.admin.success-errors-views', [ 'errors' => $errors, 'session'=>(isset($session)) ? $session : '' ])

                    <div class="table-responsive">

                      <table class="table">
                      
                        <thead>
                          <tr>
                            <th>{{ __('admin.#') }}</th>
                            <th>{{ __('admin.label.name') }}</th>
                            <th>{{ __('admin.label.description') }}</th>
                            <th>{{ __('admin.label.action') }}</th>
                          </tr>
                        </thead>

                        <tbody>

                          @if ( count($domains) == 0)
                            <tr>
                              <td colspan="7" class="align-middle">
                                <p>{{ __('admin.noDataFound') }}</p>
                              </td>
                            </tr>
                          @else

                            @foreach ($domains as $domain)
                              
                              <tr>
                                <td>{{ $domain->id }}</td>
                                <td>{{ $domain->name }}</td>
                                <td>{{ $domain->description }}</td>
                                <td>
                                  
                                  @permission('web-config-edit')
                                  <a href="{{ route('domains.edit', [ 'id' => $domain->id ]) }}" class="btn btn-sm btn-icon btn-secondary">
                                    <i class="fa fa-pencil-alt"></i>
                                    <span class="sr-only">{{ __('admin.edit') }}</span>
                                  </a>
                                  @endpermission

                                </td>
                              </tr>

                            @endforeach

                          @endif

                        </tbody>

                      </table>

                      {!! $domains->links() !!}

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