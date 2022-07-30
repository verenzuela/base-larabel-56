@extends('layouts.web.master-auth', 
    ['locale'       => '',
     'htmlCss'      => '',
     'bodyCss'      => '',
     'title'        => ENV('APP_NAME').' | Reset',
     'ogTitle'      => '',
     'ogLocale'     => '',
     'ogDescription'=> '',
     'ogUrl'        => '',
     'ogSiteName'   => '',
     'autor'        => '',
     'description'  => '',
     'canonicalUrl' => '',
    ]
)
    
  @section('styles')
  @endsection

  @section('scripts')
  @endsection

  @section('content')

    <main class="auth">
        
      <form method="POST" class="auth-form auth-form-reflow" action="{{ route('password.update') }}">
        @csrf

        {{ $token }}

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="text-center mb-4">
          <div class="mb-4">
            <img class="rounded" src="{{ asset('images/logo-transparent.png') }}" alt="" height="72">
          </div>
          <h1 class="h3">{{ __('auth.reset_password_title') }}</h1>
        </div>

        @include('commons.admin.success-errors-views', [ 'errors' => $errors, 'session'=>(isset($session)) ? $session : '' ])

        <div class="form-group mb-4">
            
          <div class="col-md-12">
            <div class="form-group">
              <div class="form-label-group">
                <input type="email" class="form-control" id="email" name="email" value="" placeholder="Email address" required autocomplete="off">
                <label for="fl5">Email address</label>
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <div class="form-label-group">
                <input type="password" class="form-control" id="password" name="password" value="" placeholder="Email address" required autocomplete="off">
                <label for="fl5">New Password</label>
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <div class="form-label-group">
                <input type="password" class="form-control" id="password-confirm" name="password_confirmation" value="" placeholder="Email address" required autocomplete="off">
                <label for="fl5">Confirm New Password</label>
              </div>
            </div>
          </div>

        </div>
          
        <div class="form-group mb-4">
          <div class="form-label-group text-center">
            <button class="btn btn-lg  btn-primary" type="submit">{{ __('auth.set_new_password') }}</button>
          </div>
        </div>
          
      </form>

      <footer class="auth-footer mt-5"> 
        {{ __('auth.auth_footer') }} 
        <a href="#">{{ __('auth.auth_footer_privacy') }}</a> 
        {{ __('auth.auth_footer_and') }} 
        <a href="#">{{ __('auth.auth_footer_term') }}</a>
      </footer>
    </main>

  @endsection