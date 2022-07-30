@extends('layouts.admin.master', $seo )

  @section('content')
    <div class="app">

      @include('layouts.admin.navbar')

      @include('layouts.admin.sidebar', [ 'menuActive' => $menuActive ])

      <main class="app-main">
        @component('components.admin.template-index',
          ['permission'   => $permission,
           'route'        => $route,
           'h1Title'      => __($h1Title),
          ]
        )
          @section('layoutContent')
            <!--  START HTML CONTENT    -->

            <div class="table-responsive">

              <table class="table">
              
                <thead>
                  <tr>
                    <th>{{ __('admin.#') }}</th>
                    <th>{{ __('admin.label.name') }}</th>
                    <th>{{ __('admin.label.status') }}</th>
                    

                    <th>{{ __('admin.label.action') }}</th>
                  </tr>
                </thead>

                <tbody>

                  @if ( count($rows) == 0)
                    <tr>
                      <td colspan="7" class="align-middle">
                        <p>{{ __('admin.noDataFound') }}</p>
                      </td>
                    </tr>
                  @else

                    @foreach ($rows as $row)
                      
                      <tr>
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->name }}</td>
                        <td>{!! $row->getStatusPreview($row->status) !!}</td>
                        

                        <td>
                          @include('commons.admin.btn-edit', [ 'permission' => $permission, 'route' => $route ])
                        
                          
                        </td>
                      </tr>

                    @endforeach

                  @endif

                </tbody>

              </table>

              {!! $rows->links() !!}

            </div>
            
            <!--  END HTML CONTENT    -->
          @endsection

        @endcomponent
      </main>

    </div>
  @endsection