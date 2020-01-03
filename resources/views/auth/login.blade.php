@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center align-middle mt-3">
        <div class="card col-12 col-md-6 col-lg-5">
            <div class="card-body px-1 py-3">
                <h1 class="d-flex justify-content-center">Sign-In</h1>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group mb-0">
                        <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mb-0">
                        <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>

                        <div>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group my-2">
                        <div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-0">
                        <div>
                            <button type="submit" class="btn btn-primary login-button mb-2">
                                {{ __('Continue') }}
                            </button>

                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </form>

                <hr class="mt-2 mb-4">
                <h5 class="d-flex justify-content-center">Don't have any account yet?</h5>
                <a href="{{ route('register') }}">
                    <button type="button" class="btn btn-light signup-button">Create account</button>
                </a>

            </div>
        </div>
    </div>
@endsection
