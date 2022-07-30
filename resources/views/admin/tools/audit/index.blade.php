@extends('layouts.admin.master', 
  ['locale'       => '',
   'bodyCss'      => '',
   'title'        => strtoupper(env('APP_NAME')).' | '.__('admin.label.audit'),
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

      @include('layouts.admin.sidebar', [ 'menuActive' => "audits" ])

      <main class="app-main">

        <div class="wrapper">
          <div class="page">
            <div class="page-inner mt-2 pt-0 ">
              <header class="page-title-bar m-0 p-0 ">

                <!-- title and toolbar -->
                <div class="d-md-flex align-items-md-start">
                  <h1 class="page-title mr-sm-auto">{{ __('admin.audit.label') }}</h1>
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
                            <th>{{ __('admin.audit.label.event') }}</th>
                            <th>{{ __('admin.audit.label.tags') }}</th>
                            <th>{{ __('admin.audit.label.type') }}</th>
                            <th>{{ __('admin.audit.label.user') }}</th>
                            <th>{{ __('admin.audit.label.ip') }}</th>
                            <th>{{ __('admin.label.createdAt') }}</th>
                            <th style="width:100px; min-width:100px;"> &nbsp; </th>
                          </tr>
                        </thead>

                        <tbody>

                          @if ( count($audits) == 0)
                            <tr>
                              <td colspan="7" class="align-middle">
                                <p>{{ __('admin.noDataFound') }}</p>
                              </td>
                            </tr>
                          @else

                            @foreach ($audits as $audit)
                              
                              <tr>
                                <td class="align-middle">{{ $audit->id }}</td>
                                <td class="align-middle" style=" color: {{ $audit->getColorAction($audit->event) }} " >{{ $audit->event }}</td>
                                <td class="align-middle">{{ $audit->tags }}</td>
                                <td class="align-middle">{{ $audit->auditable_type }}</td>
                                <td class="align-middle">{{ $audit->getUserName($audit->user_id) }}</td>
                                <td class="align-middle">{{ $audit->ip_address }}</td>
                                <td class="align-middle">{{ $audit->created_at->format('M d, Y h:i:s A') }}</td>
                                <td class="align-middle text-right">

                                  <a href="#" data-target="#modal-show-{{$audit->id}}" data-toggle="modal" class="btn btn-sm btn-icon btn-secondary">
                                    <i class="far fa-eye"></i>
                                    <span class="sr-only">{{ __('admin.show') }}</span>
                                  </a>

                                </td>
                              </tr>

                              @include('admin.tools.audit.modal-show', [ 'audit' => $audit ])

                            @endforeach

                          @endif

                        </tbody>

                      </table>

                      {!! $audits->links() !!}

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