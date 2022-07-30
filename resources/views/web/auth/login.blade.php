@extends('layouts.web.master-auth', 
    ['locale'       => '',
     'htmlCss'      => '',
     'bodyCss'      => '',
     'title'        => ENV('APP_NAME').' | Login',
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
                  //particlesJS.load('auth-header', "{{ asset('json/particles.json') }}");
                }
            )
        </script>
    @endsection

    @section('content')

        <main class="auth">
            <!--header id="auth-header" class="auth-header" style="background-image: url( '{{ asset('images/img-1.png') }}' );"-->
            <header id="auth-header" class="auth-header">
                <h1>
                    {{ __('auth.login_title') }}
                </h1>
                <p>{{ __('auth.dont_account') }} <b><a href="{{ route('register') }}">{{ __('auth.create_account') }}</a></b> </p>
            </header>

            <form class="auth-form" method="POST" action="{{ route('login') }}">
                @csrf

                <div class="col-md-12 mb-12 pt-1" id="danger-alert">
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {!! session('error') !!}
                        </div>
                    @endif
                    @if (count($errors)>0)
                    <div class="pb-3 text-danger " >
                        @foreach ($errors->all() as $error)
                            <div>
                                <i class="fa fa-exclamation-circle fa-fw"></i>{!! $error !!}
                            </div>
                        @endforeach
                    </div>
                    @endif
                </div>

                <div class="form-group">
                    <div class="form-label-group">
                        <input type="text" id="email" name="email" class="form-control @error('email') is-invalid @enderror" required autocomplete="email" autofocus value="{{ old('email') }}">
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
                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required >
                        <label for="password">{{ __('auth.password') }}</label>
                    </div>
                     @error('password')
                        <span class="small text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <button class="btn btn-lg btn-primary btn-block" type="submit">{{ __('auth.sign_in') }}</button>
                </div>

                <div class="form-group text-center">
                    <div class="custom-control custom-control-inline custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="custom-control-label" for="remember">{{ __('auth.keep_me') }}</label>
                    </div>
                </div>

                <div class="text-center pt-3">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="link">{{ __('auth.forgot_pass') }}</a>
                    @endif
                    
                </div>
            </form>

            <footer class="auth-footer"> 
                {{ __('auth.auth_footer') }} 
                <a href="#">{{ __('auth.auth_footer_privacy') }}</a> 
                {{ __('auth.auth_footer_and') }} 
                <a href="#">{{ __('auth.auth_footer_term') }}</a>
            </footer>

        </main>

    @endsection