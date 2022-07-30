@extends('layouts.admin.master', 
  ['locale'       => '',
   'bodyCss'      => '',
   'title'        => strtoupper(env('APP_NAME')).' | '.__('admin.label.emailLog'),
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

      @include('layouts.admin.sidebar', [ 'menuActive' => "emailLog" ])

      <main class="app-main">

        <div class="wrapper">
          <div class="page">
            <div class="page-inner mt-2 pt-0 ">
              <header class="page-title-bar m-0 p-0 ">

                <!-- title and toolbar -->
                <div class="d-md-flex align-items-md-start">
                  <h1 class="page-title mr-sm-auto">{{ __('admin.emailLogs.label') }}</h1>
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
                            <th>{{ __('admin.emailLogs.label.from') }}</th>
                            <th>{{ __('admin.emailLogs.label.to') }}</th>
                            <th>{{ __('admin.emailLogs.label.cc') }}</th>
                            <th>{{ __('admin.emailLogs.label.subject') }}</th>
                            <th>{{ __('admin.label.createdAt') }}</th>
                            <th>{{ __('admin.emailLogs.label.dateSent') }}</th>
                            <th> &nbsp; </th>
                          </tr>
                        </thead>

                        <tbody>

                          @if ( count($emailLogs) == 0)
                            <tr>
                              <td colspan="7" class="align-middle">
                                <p>{{ __('admin.noDataFound') }}</p>
                              </td>
                            </tr>
                          @else

                            @foreach ($emailLogs as $emailLog)
                              
                              <tr>
                                <td class="align-middle">
                                  @foreach ( json_decode(json_encode($emailLog->from),true) as $key => $value)
                                    @if($key == 'address')
                                      {{ $value }}
                                    @endif
                                  @endforeach
                                </td>
                                <td class="align-middle">{{ str_replace('"', '', $emailLog->recipient) }}</td>
                                <td class="align-middle">{{ $emailLog->cc }}</td>
                                <td class="align-middle">{{ $emailLog->subject }}</td>
                                <td class="align-middle">{!! ($emailLog->created_at) ? $emailLog->created_at->format('M d, Y') . "<br>" . $emailLog->created_at->format('  h:i:s A') : '' !!}</td>
                                <td class="align-middle">{!! ($emailLog->sent_at) ? $emailLog->sent_at->format('M d, Y') . "<br>" . $emailLog->sent_at->format('h:i:s A') : __('admin.label.noSentYet') !!}</td>
                                
                                <td class="align-middle text-right">

                                  <div class="dropdown">
                                    <button type="button" class="btn btn-icon btn-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-fw fa-ellipsis-h"></i></button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                      <div class="dropdown-arrow"></div>
                                      <!--a href="#" data-target="#modal-show-{{$emailLog->id}}" data-toggle="modal" class="dropdown-item">View Html</a -->
                                      <a href="{{ route('emails.show', [ 'id' => $emailLog->id ])  }}" target="_blank" class="dropdown-item" >View Html</a>
                                    </div>
                                  </div>

                                </td>
                              </tr>

                              {{-- @include('admin.tools.email_log.modal-show', [ 'emailLog' => $emailLog ]) --}}

                            @endforeach

                          @endif

                        </tbody>

                      </table>

                      {!! $emailLogs->links() !!}
                      
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