<div class="wrapper">
  <div class="page">
    <div class="page-inner mt-2 pt-0 ">
      <header class="page-title-bar m-0 p-0 ">

        @include('commons.admin.btn-create', [ 'permission' => $permission, 'route' => $route ])

        <!-- title and toolbar -->
        <div class="d-md-flex align-items-md-start">
          <h1 class="page-title mr-sm-auto">{{ $h1Title }}</h1>
        </div>
      
      </header>
      
      <div class="page-section">
        <div class="card card-fluid">

          <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                <a class="nav-link active show" data-toggle="tab" href="#tab1">{{ __('admin.all') }}</a>
              </li>
            </ul>
          </div>

          <div class="card-body">
            
            @include('commons.admin.success-errors-views', [ 'errors' => $errors, 'session'=>(isset($session)) ? $session : '' ])
            
            @yield('layoutContent')
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>    
