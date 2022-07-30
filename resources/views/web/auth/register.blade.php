@extends('layouts.web.master-auth', 
    ['locale'       => '',
     'htmlCss'      => '',
     'bodyCss'      => '',
     'title'        => ENV('APP_NAME').' | Register',
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
        <script src="{{ asset('js/particles.min.js') }}"></script>
        <script>
            $(document).on('theme:init', () =>
                {
                  particlesJS.load('auth-header', "{{ asset('json/particles.json') }}");
                }
            )
        </script>
    @endsection

    @section('content')

        <main class="auth">
            <header id="auth-header" class="auth-header" style="">
                <h1>
                    {{ __('auth.register_title') }}
                </h1>
            </header>

            <form class="auth-form" method="POST" action="{{ route('register') }}">
                @csrf
            
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autofocus>
                        <label for="name">{{ __('auth.name') }}</label>
                        @error('name')
                            <span class="small text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-label-group">
                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus>
                        <label for="email">{{ __('auth.email') }}</label>
                        @error('email')
                            <span class="small text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-label-group">
                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" required autofocus>
                        <label for="password">{{ __('auth.password') }}</label>
                        @error('password')
                            <span class="small text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-label-group">
                        <input type="password" id="password-confirm" name="password_confirmation" class="form-control" required autofocus>
                        <label for="password-confirm">{{ __('auth.password_confirm') }}</label>
                        
                    </div>
                </div>
                
                <div class="row mb-2">
                    <div class="col-6">
                        <button class="btn btn-lg btn-block btn-primary" type="submit">{{ __('auth.sign_up') }}</button>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('login') }}" class="btn btn-lg btn-block btn-light">{{ __('auth.return_login') }}</a>
                    </div>
                </div>

                <div class="form-group text-center">
                    <div class="custom-control custom-control-inline custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="newsletter">
                        <label class="custom-control-label" for="newsletter">{{ __('auth.sign_newsletter') }}</label>
                    </div>
                </div>
                
                
                <p class="text-center text-muted mb-0">
                    {{ __('auth.accep_terms') }}
                    <a href="#">{{ __('auth.accep_terms_use') }}</a> 
                    {{ __('auth.auth_footer_and') }}
                    <a href="#">{{ __('auth.accep_policy') }}</a>. 
                </p>
            
            </form>
            
            <footer class="auth-footer"> 
                {{ __('auth.auth_footer') }}
            </footer>

        </main>

    @endsection