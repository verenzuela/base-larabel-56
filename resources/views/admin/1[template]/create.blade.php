@extends('layouts.admin.master', $seo )
  
  @section('content')
    <div class="app">

      @include('layouts.admin.navbar')

      @include('layouts.admin.sidebar', [ 'menuActive' => $menuActive ])

      <main class="app-main">
        @component('components.admin.template-create',
          ['permission'   => $permission,
           'route'        => $route,
           'h1Title'      => __($h1Title.'.create'),
          ]
        )
          @section('layoutContent')
          <!--  START HTML CONTENT    -->

            

          <!--  END HTML CONTENT    -->
          @endsection

        @endcomponent
      </main>

    </div>
  @endsection
