@extends('app')

@section('content')
<section class="hero">
    <div class="hero-body">
        <div class="container">
            <div class="columns">
                <div class="column is-4 is-offset-4">
                    <div class="card">
                        <div class="card-header">
                            <p class="card-header-title">{{ __('Login') }}</p>
                        </div>

                        <div class="card-content">
                            {!! Form::open(['route' => 'login']) !!}
                            <div class="field">
                                <label for="email" class="label">{{ __('E-Mail Address') }}</label>
                                <div class="control">
                                    <input id="email" type="email" class="input{{ $errors->has('email') ? ' is-danger' : '' }}"
                                        name="email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                    <p class="help is-danger">{{ $errors->first('email') }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="field">
                                <label for="password" class="label">{{ __('Password') }}</label>
                                <div class="control">
                                    <input id="password" type="password" class="input{{ $errors->has('password') ? ' is-danger' : '' }}"
                                        name="password" required>

                                    @if ($errors->has('password'))
                                    <p class="help is-danger">{{ $errors->first('password') }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="field has-text-centered">
                                <label class="checkbox" for="remember">
                                    <input class="checkbox" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>
                                    {{ __('Remember Me') }}
                                </label>
                            </div>

                            <div class="field">
                                <div class="control">
                                    <button type="submit" class="button is-link is-fullwidth">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>

                    <div class="has-text-centered">
                        @if (Route::has('register'))
                        <a href="{{ route('register') }}">{{ __('Sign up') }}</a>&nbsp;&nbsp;
                        @endif
                        <a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
