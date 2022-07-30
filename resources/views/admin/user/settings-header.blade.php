
<header class="page-cover">
  <div class="text-center">
    <a href="{{ route('user.profile', [ 'userId' => Auth::user()->id ] ) }}" class="user-avatar user-avatar-xl">
      <img src="{{ ($user->img_url) ? $user->img_url : asset('images/user.jpeg') }}" alt="">
    </a>
    <h2 class="h5 mt-2 mb-0">{{ $user->name }}</h2>
    <p class="text-muted"> {{ $user->email }} </p>
    <p>  </p>
  </div>
</header>