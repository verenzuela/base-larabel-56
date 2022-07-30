<aside class="app-aside app-aside-expand-md app-aside-light">
  
  <div class="aside-content">
    
    <header class="aside-header d-block d-md-none">

      <button class="btn-account" type="button" data-toggle="collapse" data-target="#dropdown-aside">
        <span class="user-avatar user-avatar-lg">
          <img src="{{ asset('images/user.jpeg') }}" alt="">
        </span>
        <span class="account-icon">
          <span class="fa fa-caret-down fa-lg"></span>
        </span>
        @if(Auth::user())
        <span class="account-summary">
          <span class="account-name">{{ Auth::user()->name }}</span>
              <span class="account-description">{{ Auth::user()->email }}</span>
        </span>
        @endif
      </button> 

      <div id="dropdown-aside" class="dropdown-aside collapse">
        
        <div class="pb-3">
          @if(Auth::user())
          <a class="dropdown-item" href="{{ route('user.profile', [ 'userId' => Auth::user()->id ] ) }}">
            <span class="dropdown-icon oi oi-person"></span> 
            {{ __('admin.label.profile') }}
          </a>
          @endif
          <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <span class="dropdown-icon oi oi-account-logout"></span>                                
            {{ __('admin.label.logout') }}
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
          
          <div class="dropdown-divider"></div>
          
          <a class="dropdown-item" href="#">{{ __('admin.label.helpCenter') }}</a>
        </div>
      </div>

    </header>

    <div class="aside-menu overflow-hidden">
      
      <nav id="stacked-menu" class="stacked-menu">
        
        <ul class="menu">

          <!-- DASHBOARD -->
          @permission('menu-dashboard')
          <li class="menu-item {{ ( $menuActive =='dashboard') ? 'has-active' : '' }} ">
            <a href="{{ route('admin.index') }}" class="menu-link">
              <span class="menu-icon fas fa-tachometer-alt"></span> 
              <span class="menu-text">{{ __('admin.label.dashboard') }}</span>
            </a>
          </li>
          @endpermission

          <!-- USERS -->
          <li class="menu-item has-child {{ ( substr($menuActive, 0, 9) =='contracts') ? 'has-open' : '' }} ">
            <a href="#" class="menu-link">
              <span class="menu-icon fas fa-list-alt"></span> 
              <span class="menu-text">{{ __('admin.label.contracts') }}</span>
            </a>
            <ul class="menu">

              <li class="menu-item {{ ( $menuActive =='contracts_all') ? 'has-active' : '' }} "  >
                <a href="{{ route('user.type.list', ['userType'=>'backend'] ) }}" class="menu-link">{{ __('admin.label.contracts_all') }}</a>
              </li>

              <li class="menu-item {{ ( $menuActive =='contracts_documents') ? 'has-active' : '' }} "  >
                <a href="{{ route('user.type.list', ['userType'=>'backend'] ) }}" class="menu-link">{{ __('admin.label.contracts_documents') }}</a>
              </li>

              <li class="menu-item {{ ( $menuActive =='contracts_terms') ? 'has-active' : '' }} "  >
                <a href="{{ route('user.type.list', ['userType'=>'backend'] ) }}" class="menu-link">{{ __('admin.label.contracts_terms') }}</a>
              </li>
            </ul>
          </li>

          <!-- USERS -->
          @permission('menu-user')
          <li class="menu-item has-child {{ ( substr($menuActive, 0, 5) =='users') ? 'has-open' : '' }} ">
            @permission('menu-auth')
            <a href="#" class="menu-link">
              <span class="menu-icon fas fa-users"></span>
              <span class="menu-text">{{ __('admin.label.users') }}</span>
            </a>
            <ul class="menu">

              @permission('user-list')
              <li class="menu-item {{ ( $menuActive =='users_system') ? 'has-active' : '' }} "  >
                <a href="{{ route('user.type.list', ['userType'=>'backend'] ) }}" class="menu-link">{{ __('admin.label.userSystem') }}</a>
              </li>
              @endpermission

              @permission('members-list')
              <li class="menu-item {{ ( $menuActive =='users_front') ? 'has-active' : '' }} "  >
                <a href="{{ route('user.type.list', ['userType'=>'frontend'] ) }}" class="menu-link">{{ __('admin.label.userFront') }}</a>
              </li>
              @endpermission

              @permission('blacklist-list')
              <li class="menu-item {{ ( $menuActive =='users_blacklist') ? 'has-active' : '' }} "  >
                <a href="{{ route('blacklist.index') }}" class="menu-link">{{ __('admin.label.userBlackList') }}</a>
              </li>
              @endpermission
              
            </ul>
            @endpermission
          </li>
          @endpermission

          <!-- AUDIT -->
          @permission('menu-audit')
          <li class="menu-item {{ ( $menuActive =='audits') ? 'has-active' : '' }} ">
            @permission('audit-list')
            <a href="{{ route('audits.index') }}" class="menu-link">
              <span class="menu-icon fas fa-binoculars"></span> 
              <span class="menu-text">{{ __('admin.label.audit') }}</span>
            </a>
            @endpermission
          </li>
          @endpermission
          
          <!-- EMAIL LOG -->
          @permission('menu-email-log')
          <li class="menu-item {{ ( $menuActive =='emailLog') ? 'has-active' : '' }} ">
            @permission('email-list')
            <a href="{{ route('emails.index') }}" class="menu-link">
              <span class="menu-icon fas fa-envelope"></span> 
              <span class="menu-text">{{ __('admin.label.emailLog') }}</span>
            </a>
            @endpermission
          </li>
          @endpermission

        </ul>
      </nav>
    </div>
    
    <!--footer class="aside-footer border-top p-3">
      <button class="btn btn-light btn-block text-primary" data-toggle="skin">{{ __('admin.label.nightMode') }}<i class="fas fa-moon ml-1"></i></button>
    </footer-->

  </div>
</aside>