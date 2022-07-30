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
                    
                    

                    <th>{{ __('admin.label.action') }}</th>
                  </tr>
                </thead>

                <tbody>
                  @forelse ($rows as $row)

                    <tr>
                      <td>{{ $row->id }}</td>
                      
                      

                      <td>
                        @include('commons.admin.btn-edit', [ 'permission' => $permission, 'route' => $route ])
                      
                        @include('commons.admin.btn-delete-modal', [ 'permission' => $permission, 'route' => $route, 'row' => $row ])
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

              {!! $rows->links() !!}

            </div>
            
            <!--  END HTML CONTENT    -->
          @endsection

        @endcomponent
      </main>

    </div>
  @endsection