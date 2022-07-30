
<div class="card card-fluid">
  <h6 class="card-header">{{ __('admin.label.settings') }}</h6>
  <nav class="nav nav-tabs flex-column border-0">

    @permission('user-settings')
    <a href="{{ route('user.profile', [ 'userId' => Auth::user()->id ] ) }}" class="nav-link {{ ( $activeSide =='profile') ? 'active' : '' }}">
    	{{ __('admin.label.profile') }}
    </a>
    @endpermission


    @permission('user-settings')
    <a href="{{ route('user.security', [ 'userId' => Auth::user()->id ] ) }}" class="nav-link {{ ( $activeSide =='account') ? 'active' : '' }}">
        {{ __('admin.profile.label.security') }}
    </a>  
    @endpermission
{{--
    @permission('user-settings')
    <a href="{{ route('user.notifications', [ 'userId' => Auth::user()->id ] ) }}" class="nav-link {{ ( $activeSide =='notifications') ? 'active' : '' }}">
        {{ __('admin.profile.label.notifications') }}
    </a>
    @endpermission
--}}

  </nav>
</div>