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
            
            <form class="auth-form auth-form-reflow" method="POST" action="{{ route('password.email') }}">
                @csrf

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="text-center mb-4">
                    <div class="mb-4">
                        <img src="{!! route('assets.image', [ 'w'=>80, 'h'=>80, 'imagePath'=> $logo ]) !!}">
                    </div>
                    <h1 class="h3">{{ __('auth.reset_password_title') }}</h1>
                </div>

                <div class="form-group mb-4">
                    <label class="d-block text-left" for="email">{{ __('auth.email') }}</label>
                    <input type="text" id="email" name="email" class="form-control form-control-lg" required="" autofocus="">
                    @error('email')
                        <span class="small text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <p class="text-muted">
                        <small>{{ __('auth.we_send_email') }}</small>
                    </p>
                </div>
                
                <div class="row">
                    <div class="col-6">
                        <button class="btn btn-lg btn-block btn-primary" type="submit">{{ __('auth.btn_reset') }}</button>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('login') }}" class="btn btn-lg btn-block btn-light">{{ __('auth.return_login') }}</a>
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