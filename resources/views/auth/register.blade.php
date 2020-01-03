@extends('layouts.app')

@section('content')

    <div class="container d-flex justify-content-center align-middle mt-3">
        <div class="card col-12 col-md-6 col-lg-5">
            <div class="card-body px-1 py-3">
                <h1 class="d-flex justify-content-center">Create Account</h1>
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group mb-0">
                        <label for="name" class="col-form-label text-md-left">{{ __('Account Name') }}</label>

                        <div>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mb-0">
                        <label for="email" class="col-form-label text-md-left">{{ __('E-Mail Address') }}</label>

                        <div>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mb-0">
                        <label for="password" class="col-form-label text-md-left">{{ __('Password') }}</label>

                        <div>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mb-0">
                        <label for="password-confirm" class="col-form-label text-md-left">{{ __('Confirm Password') }}</label>

                        <div>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="form-group mb-0 mt-3">
                        <div>
                            <button type="submit" class="btn btn-primary signup-button">
                                {{ __('Continue') }}
                            </button>
                        </div>
                    </div>
                </form>

                <small id="emailHelp" class="d-flex form-text text-muted justify-content-center">We will send you a text to verify your email.</small>
                <hr class="mt-2 mb-4">
                <p>Already have an account?
                    <a href="{{ route('login') }}">Sign-in</a>
                </p>
            </div>
        </div>
    </div>


@endsection
