@extends('layouts.app')

@section('content')
<style>
    .card-header {
        background-color: #3498db; /* Blue color */
        color: #fff; /* White text */
    }

    .card-body {
        background-color: #f5f5f5; /* Light gray background */
    }

    .form-control {
        border-color: #3498db; /* Blue border */
    }

    .btn-primary {
        background-color: #3498db; /* Blue button */
        border-color: #3498db; /* Blue border */
    }

    .btn-primary:hover {
        background-color: #2980b9; /* Darker blue on hover */
        border-color: #2980b9; /* Darker blue border on hover */
    }

    .btn-white {
        color: #3498db; /* Blue text */
    }

    .btn-white:hover {
        color: #2980b9; /* Darker blue text on hover */
    }

    /* You can adjust other styles as needed */
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <h2 class="text-center mb-4">Login</h2>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
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

                        <div class="row mb-3 mt-5">
                            <label for="password" class="col-md-4 col-form-label text-md-end">OR</label>

                            <div class="col-md-6">
                               <a href="/auth/google/redirect" class="btn btn-white">Sign in to Google</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
