@extends('app')

@section('content')
<section class="hero">
    <div class="hero-body">
        <div class="container">
            <div class="columns">
                <div class="column is-4 is-offset-4">

                    <div class="card">
                        <div class="card-header">
                            <p class="card-header-title">{{ __('Sign up') }}</p>
                        </div>

                        <div class="card-content">
                            {!! Form::open(['route' => 'register']) !!}

                            <div class="field">
                                <label for="name" class="label">{{ __('Name') }}</label>
                                <div class="control">
                                    <input id="name" type="text" class="input{{ $errors->has('name') ? ' is-danger' : '' }}"
                                        name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                    <p class="help is-danger">{{ $errors->first('name') }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="field">
                                <label for="email" class="label">{{ __('E-Mail Address') }}</label>
                                <div class="control">
                                    <input id="email" type="email" class="input{{ $errors->has('email') ? ' is-danger' : '' }}"
                                        name="email" value="{{ old('email') }}" required>

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

                            <div class="field">
                                <label for="password-confirm" class="label">{{ __('Confirm Password') }}</label>
                                <div class="control">
                                    <input id="password-confirm" type="password" class="input" name="password_confirmation"
                                        required>
                                </div>
                            </div>

                            <div class="field">
                                <div class="control">
                                    <button type="submit" class="button is-link is-fullwidth">
                                        {{ __('Sign up') }}
                                    </button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>

                    <div class="has-text-centered">
                        Have an account? <a href="{{ route('login') }}">{{ __('Log in') }}</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
