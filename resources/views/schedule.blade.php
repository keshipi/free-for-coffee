@extends('app')

@section('content')


<div class="alert alert-danger">
</div>

<div class="container has-text-centered">
    <div class="columns">
        <div class="column is-6 is-offset-3">
            @if ($errors->any())
            <div class="message is-danger">
                <p class="message-body">
                    wrong value detected... try again
                </p>
            </div>
            @endif

            <h3 class="title is-4">tell us your tomorrow schedule</h3>
            <h4 class="title is-5">{{ $tomorrow->format(config('app.date_format_show')) }}</h4>

            {!! Form::open(['method' => 'post', 'route' => ['schedule.store']]) !!}
            <div class="tags">
                <div class="field is-grouped is-grouped-multiline">
                    @foreach($slots as $i => $slot)
                    <div class="control">
                        <div class="tag is-large is-white is-rounded">
                            <label for="slots_{{ $i }}" class="label">
                                {{ Form::checkbox('slots[]', $slot, isset($schedule) ? $schedule->hasSlot($slot) :
                                false,
                                ['id' => 'slots_' . $i]) }}
                                {{ $slot }}
                            </label>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="field">
                <div class="control has-text-centered">
                    <button type="submit" class="button is-link">
                        {{ __('save') }}
                    </button>
                </div>
            </div>
            {!! Form::close() !!}
            <br>

            @if (isset($schedule) && count($schedule->getSlots()) !== 0)
            <a class="button is-primary is-fullwidth" href="{{ route('partner.index') }}">
                {{ __('have coffee with someone?') }}
            </a>
            @endif

        </div>
    </div>
</div>
@endsection
