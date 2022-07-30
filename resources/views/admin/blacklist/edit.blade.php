@extends('layouts.admin.master', $seo )
  
  @section('content')
    <div class="app">

      @include('layouts.admin.navbar')

      @include('layouts.admin.sidebar', [ 'menuActive' => $menuActive ])

      <main class="app-main">
        @component('components.admin.template-edit',
          ['permission'   => $permission,
           'route'        => $route,
           'h1Title'      => __($h1Title.'.update'),
           'row'          => $row,
          ]
        )
          @section('layoutContent')
          <!--  START HTML CONTENT    -->

            <div class="col-md-6">
              {!! $render->inpunt('firstname', $row->firstname, $errors, false) !!}
            </div>
            <div class="col-md-6">
              {!! $render->inpunt('lastname', $row->lastname, $errors, false) !!}
            </div>
            <div class="col-md-6">
              {!! $render->inpunt('phone', $row->phone, $errors, false) !!}
            </div>  
            <div class="col-md-6">
              {!! $render->inpunt('email', $row->email, $errors, true) !!}
            </div>

          <!--  END HTML CONTENT    -->
          @endsection

        @endcomponent
      </main>

    </div>
  @endsection