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
              {!! $render->inpunt('firstname', false, $errors, false) !!}
            </div>
            <div class="col-md-6">
              {!! $render->inpunt('lastname', false, $errors, false) !!}
            </div>
            <div class="col-md-6">
              {!! $render->inpunt('phone', false, $errors, false) !!}
            </div>  
            <div class="col-md-6">
              {!! $render->inpunt('email', false, $errors, true) !!}
            </div>

          <!--  END HTML CONTENT    -->
          @endsection

        @endcomponent
      </main>

    </div>
  @endsection
