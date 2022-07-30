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
          <div class="card-body pt-1">
            
            {!!Form::model($row,['method'=>'PATCH', 'files'=>true, 'autocomplete'=>'off', 'route'=>[$route.'.update',$row->id], 'id'=>'FormMultyEdit-'.$row->id  ])!!}

              @include('commons.admin.success-errors-views', [ 'errors' => $errors, 'session'=>(isset($session)) ? $session : '' ])

              <fieldset>

                <!-- Button -->
                @permission($permission.'-edit')
                
                
                  <div class="container mb-2">
                    <div class="row">
                      <div class="col text-right">

                        @if($btnShippingmethod)
                        <a id="btnShippingMethod-{{$row->id}}" href="{{ route('product.configure.shipping.method.show', ['id'=>$row->id]) }}" class="btn btn-warning">{{ __('admin.configureShippingMethods') }}</a>
                        @endif
                        
                        <button type="submit" class="btn btn-primary">{{ __('admin.update') }}</button>

                      </div>
                    </div>
                  </div>
                  
                
                @endpermission
                <hr>
                @yield('layoutContent')

              </fieldset>
            {!!Form::close()!!}

            <fieldset>
              @yield('contentOutForm')
            </fieldset>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>