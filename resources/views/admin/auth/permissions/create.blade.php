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

            <div class="col-md-6">
              {!! $render->inpunt('name', false, $errors, true) !!}
            </div>
            <div class="col-md-6">
              {!! $render->inpunt('display_name', false, $errors, true) !!}
            </div>
            <div class="col-md-6">
              {!! $render->inpunt('description', false, $errors) !!}
            </div>

          <!--  END HTML CONTENT    -->
          @endsection

        @endcomponent
      </main>

    </div>
  @endsection
