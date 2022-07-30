@extends('layouts.admin.master', 
  ['locale'       => '',
   'bodyCss'      => '',
   'title'        => strtoupper(env('APP_NAME')).' | '.__('admin.label.landig_page_config'),
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

      @include('layouts.admin.sidebar', [ 'menuActive' => "landing_page_" . $sectionName ])

      <main class="app-main">

        <div class="wrapper">
          <div class="page">
            <div class="page-inner mt-2 pt-0 ">
              <header class="page-title-bar m-0 p-0 ">
                @permission('landing_page-create')
                  @if( ($configs && $configs->count() < $settings->max_rows ) || !$configs )
                    <a href="{{ route('landing-page-config.create', ['sectionName' => $sectionName]) }}" class="btn btn-success btn-floated pt-3"><span class="fa fa-plus"></span></a>
                  @endif
                @endpermission

                <!-- title and toolbar -->
                <div class="d-md-flex align-items-md-start">
                  <h1 class="page-title mr-sm-auto">{{ __('admin.landing_page.' . $sectionName) }}</h1>
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

                              @if( $settings->use_image )
                              <th>{{ __('admin.label.image') }}</th>
                              @endif

                              <th>{{ __('admin.label.name') }}</th>
                              <th style="width:100px; min-width:100px;"> &nbsp; </th>
                            </tr>
                          </thead>

                          <tbody>
                            @forelse ($configs as $config)
                              <tr>
                                <td>{{ $config->id }}</td>

                                @if( $settings->use_image )
                                <th class="align-middle">
                                  <img src="{!! $config->getFirstImage(50, 50) !!}" >
                                </th>
                                @endif

                                <td>{{ $config->name }}</td>
                                <td>
                                  
                                  <a href="{{ route('landing-page-config.edit', ['id' => $config->id]) }}" class="btn btn-sm btn-icon btn-secondary">
                                    <i class="fa fa-pencil-alt"></i>
                                    <span class="sr-only">{{ __('admin.edit') }}</span>
                                  </a>

                                </td>
                              </tr>
                            @empty
                              <tr>
                                <td colspan="7" class="align-middle">
                                  <p>{{ __('admin.noDataFound') }}</p>
                                </td>
                              </tr>
                            @endforelse
                          </tbody>

                        </table>

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