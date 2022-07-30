<!-- .app-header -->
<header class="app-header app-header-dark">
  <!-- .top-bar -->
  <div class="top-bar">
    <!-- .top-bar-brand -->
    <div class="top-bar-brand">
      <a href="{{ route('admin.index') }}"> {{ strtoupper( config('app.name', 'Laravel') ) }} </a>
    </div><!-- /.top-bar-brand -->
    <!-- .top-bar-list -->
    <div class="top-bar-list">
      <!-- .top-bar-item -->
      <div class="top-bar-item px-2 d-md-none d-lg-none d-xl-none">
        <!-- toggle menu -->
        <button class="hamburger hamburger-squeeze" type="button" data-toggle="aside" aria-label="toggle menu"><span class="hamburger-box"><span class="hamburger-inner"></span></span></button> <!-- /toggle menu -->
      </div><!-- /.top-bar-item -->
      
      <!-- .top-bar-item -->
      <div class="top-bar-item top-bar-item-full text-right d-block pr-2">
        

        <div class="dropdown">
          <button class="btn btn-secondary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span>{{ __('admin.language')  }} ({{ LaravelLocalization::getCurrentLocale() }})</span> <i class="fa fa-fw fa-caret-down"></i>
          </button> 

          <!-- .dropdown-menu -->
          <div class="dropdown-menu dropdown-menu-right dropdown-menu-md stop-propagation" style="">
            <div class="dropdown-arrow"></div><!-- .custom-control -->
            
            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            <div class="custom-control custom-radio">
              <a class="custom-control-label d-flex justify-content-between" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                {{ $properties['native'] }}
              </a>
            </div><!-- /.custom-control -->
             @endforeach
            

          </div><!-- /.dropdown-menu -->
        </div>


      </div><!-- /.top-bar-item -->
      
      <!-- .top-bar-item -->
      <div class="top-bar-item top-bar-item-right px-0 d-none d-sm-flex">
        @if(Auth::user())
        <!-- .btn-account -->
        <div class="dropdown d-flex">
          <button class="btn-account d-none d-md-flex" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="user-avatar user-avatar-md">
              <img src="{{ (Auth::user()->img_url) ? Auth::user()->img_url : asset('images/user.jpeg') }}" class="img-circle elevation-2" alt="User Image">
            </span>
            <span class="account-summary pr-lg-4 d-none d-lg-block">
              <span class="account-name">{{ Auth::user()->name }}</span>
              <span class="account-description">{{ Auth::user()->email }}</span>
            </span>
          </button> <!-- .dropdown-menu -->
          
          <div class="dropdown-menu">
            <div class="dropdown-arrow ml-3"></div>
            <h6 class="dropdown-header d-none d-md-block d-lg-none">{{ Auth::user()->name }}</h6>
            <a class="dropdown-item" href="{{ route('user.profile', [ 'userId' => Auth::user()->id ] ) }}">
              <span class="dropdown-icon oi oi-person"></span>
              {{ __('admin.label.profile') }}
            </a>
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <span class="dropdown-icon oi oi-account-logout"></span>                                
              {{ __('admin.label.logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>

            <div class="dropdown-divider"></div>
            
            <a class="dropdown-item" href="#">{{ __('admin.label.helpCenter') }}</a>
          </div><!-- /.dropdown-menu -->

        </div><!-- /.btn-account -->
        @endif
      </div><!-- /.top-bar-item -->

    </div><!-- /.top-bar-list -->
  </div><!-- /.top-bar -->
</header><!-- /.app-header -->