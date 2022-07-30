<div class="wrapper">
  <div class="page">
    <div class="page-inner mt-2 pt-0 ">
      <header class="page-title-bar m-0 p-0 ">

        <!-- title and toolbar -->
        <div class="d-md-flex align-items-md-start">
          <h1 class="page-title mr-sm-auto">{{ $h1Title }}</h1>
        </div>
      
      </header>
      
      <div class="page-section">
        <div class="card card-fluid">
          <div class="card-body">
            
            {!!Form::model($row,['method'=>'PATCH', 'files'=>true, 'autocomplete'=>'off', 'route'=>[$route.'.update',$row->id]])!!}

              @include('commons.admin.success-errors-views', [ 'errors' => $errors, 'session'=>(isset($session)) ? $session : '' ])

              <fieldset>

                @yield('layoutContent')

                <!-- Button -->
                @permission($permission.'-edit')
                <div class="publisher-actions">
                  <div class="publisher-tools mr-auto"></div>
                  <button type="submit" class="btn btn-primary">{{ __('admin.update') }}</button>
                </div>
                @endpermission

              </fieldset>
            {!!Form::close()!!}

          </div>
        </div>
      </div>
    </div>
  </div>
</div>