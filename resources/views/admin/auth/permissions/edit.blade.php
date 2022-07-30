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
              {!! $render->inpunt('name', $row->name, $errors, true) !!}
            </div>
            <div class="col-md-6">
              {!! $render->inpunt('display_name', $row->display_name, $errors, true) !!}
            </div>
            <div class="col-md-6">
              {!! $render->inpunt('description', $row->description, $errors) !!}
            </div>

          <!--  END HTML CONTENT    -->
          @endsection

        @endcomponent
      </main>

    </div>
  @endsection