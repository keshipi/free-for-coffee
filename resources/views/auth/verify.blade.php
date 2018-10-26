@extends('layouts.app')

@section('content')
<section class="hero">
    <div class="hero-body">
        <div class="container">
            <div class="columns">
                <div class="column is-4 is-offset-4">

                    <div class="card">
                        <div class="card-header">
                            <p class="card-header-title">{{ __('Verify Your Email Address') }}</p>
                        </div>

                        <div class="card-content">
                            @if (session('resent'))
                            <div class="message is-success">
                                <div class="message-body">
                                    {{ __('A fresh verification link has been sent to your email address.') }}
                                </div>
                            </div>
                            @endif

                            {{ __('Before proceeding, please check your email for a verification link.') }}
                            {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{
                                __('click here to request another') }}</a>.
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
