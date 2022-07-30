
<nav class="page-navs">
  <div class="nav-scroller">
    <div class="nav nav-center nav-tabs">
      <a class="nav-link {{ ( $activeNav =='settings') ? 'active' : '' }}" href="{{ route('user.profile', [ 'userId' => Auth::user()->id ] ) }}">
      	{{ __('admin.label.settings') }}
      </a>
    </div>
  </div>
</nav>