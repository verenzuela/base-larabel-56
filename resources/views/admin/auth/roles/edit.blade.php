@extends('layouts.admin.master', $seo )
  
  @push('scripts')
    <script type="text/javascript">

      function addPermission(idRole, idPermission){
        $.ajax({
            method: "get",
            url: '/roles/'+idRole+'/'+idPermission+'/addPermission',
            data: '',
        }).done(function( response ) {
          if(!response){
            alert('Error add permission.');
          }
        });
      }


      function removePermission(idRole, idPermission){
        $.ajax({
            method: "get",
            url: '/roles/'+idRole+'/'+idPermission+'/removePermission',
            data: '',
        }).done(function( response ) {
          if(!response){
            alert('Error remove permission.');
          }
        });
      }


      $('input[type=checkbox]').click(function() {
        if($(this).is(':checked')) {
          addPermission( $('#idRole').val() , $(this).val())
        } else {
          removePermission( $('#idRole').val() , $(this).val())
        }
      });
      
    </script>
  @endpush

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

            <input type="hidden" id="idRole" name="idRole" value="{{ $row->id }}">

            <div class="col-md-6">
              {!! $render->inpunt('name', $row->name, $errors, true) !!}
            </div>
            <div class="col-md-6">
              {!! $render->inpunt('display_name', $row->display_name, $errors, true) !!}
            </div>
            <div class="col-md-6">
              {!! $render->inpunt('description', $row->description, $errors) !!}
            </div>
            
            <div class="col-md-6">
              @foreach($permissions as $value)
                <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                {{ $value->display_name }}</label>
                <br/>
              @endforeach
            </div>

          <!--  END HTML CONTENT    -->
          @endsection

        @endcomponent
      </main>

    </div>
  @endsection