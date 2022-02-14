@extends('layouts.public')

@section('content')
    <div class="container-fluid">
        <div class="row align-items-center" >
            <div class="col text-center min-vh-100 p-5 d-md-block d-none">
                <div id="particles-js" style="position: absolute; top: 0; height: 95%; width: 95%; z-index: -1;background-color: #ECEFF1"></div>
                <img src="{{asset('img/par-servicios-logo-dark.png')}}" class="img-fluid mb-5">
                <br>
                <img src="{{asset('img/banner.png')}}" class="img-fluid mt-5">

            </div>
            <div class="col">
                <div class="row align-items-center px-5 mt-sm-5">
                    <div class="col-md-8 col-xs-12">
                        <h3 class="card-title">INGRESAR</h3>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email"
                                       class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>


                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="form-group">
                                <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>
                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror" name="password"
                                       required
                                       autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group float-right">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember"
                                               id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-0">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('js/particles/particles.js')}}"></script>
    <script type="text/javascript">
        particlesJS.load('particles-js', '{{asset('js/particles/particlesjs-config.json')}}', function() {
            console.log('callback - particles.js config loaded');
        });
    </script>
@endsection
