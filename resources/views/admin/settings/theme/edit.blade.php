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

            <div class="row">
              <div class="col-12 col-md-4">
                {!! $render->inpunt('name', $row->name, $errors, $required=false, $customLabel=false, $editable=false ) !!}
              </div>
            </div>
            
            <div class="row">
              <div class="col-12 col-md-4">
                <div class="row">
                  <div class="col-6">
                    {!! $render->colorPicker('principal_color', $row->principal_color, $errors, $required=false, $customLabel=false, $editable=true) !!}
                  </div>
                  <div class="col-6 text-left">
                    {!! $render->switch('custom_principal_color', $row->custom_principal_color, '', true) !!}
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-12 col-md-4">
                <div class="row">
                  <div class="col-6">
                    {!! $render->inpunt('pagination', $row->pagination, $errors, $required=false, $customLabel=false, $editable=true, $classOnFirstDiv='', $classOnInput='text-right' ) !!}
                  </div>
                  <div class="col-6 text-left">
                    {!! $render->switch('custom_pagination', $row->custom_pagination, '', true) !!}
                  </div>
                </div>
              </div>
            </div>

            
            <div class="row">
              <div class="col-12 col-md-4">
                {!! $render->switch('enable_shopping_cart', $row->enable_shopping_cart, '', true) !!}
              </div>
            </div>

            <div class="row">
              <div class="col-12 col-md-4">
                {!! $render->switch('enable_questions_produtcs', $row->enable_questions_produtcs, '', true) !!}
              </div>
            </div>


            <div class="row">
              <div class="col-12 col-md-4">
                {!! $render->switchWhitText('status', $row->status, $customLabel='active') !!}
              </div>
            </div>

          <!--  END HTML CONTENT    -->
          @endsection

        @endcomponent
      </main>

    </div>
  @endsection