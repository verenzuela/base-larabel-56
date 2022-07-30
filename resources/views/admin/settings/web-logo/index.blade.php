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
                        <td>{{ $row->display_name }}</td>
                        <td>
                          {!! ($row->status) ? 
                            "<span class='badge badge-subtle badge-success'>".__('admin.on')."</span>"
                            : "<span class='badge badge-subtle badge-dark'>".__('admin.off')."</span>"
                          !!}
                        </td>
                        <td>
                          @include('commons.admin.btn-edit', [ 'permission' => $permission, 'route' => $route ])
                          
                          @if($row->custom)
                            @include('commons.admin.btn-delete-modal', [ 'permission' => $permission, 'route' => $route, 'row' => $row ])
                          @endif
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