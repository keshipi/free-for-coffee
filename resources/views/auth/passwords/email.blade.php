@extends('app')

@section('content')
<section class="hero">
    <div class="hero-body">
        <div class="container">
            <div class="columns">
                <div class="column is-4 is-offset-4">

                    <div class="card">
                        <div class="card-header">
                            <p class="card-header-title">{{ __('Reset Password') }}</p>
                        </div>

                        <div class="card-content">
                            @if (session('status'))
                            <div class="message is-success">
                                <div class="message-body">
                                    {{ session('status') }}
                                </div>
                            </div>
                            @endif

                            {!! Form::open(['route' => 'password.email']) !!}
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
                                <div class="control">
                                    <button type="submit" class="button is-link is-fullwidth">
                                        {{ __('Send Password Reset Link') }}
                                    </button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
