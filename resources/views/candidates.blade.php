@extends('app')

@section('content')
<div class="container has-text-centered">
    <div class="columns">
        <div class="column is-6 is-offset-3">

            @if (count($candidates) !== 0)
            <h3 class="title is-4">you and {{ $user->getName() }} can have coffee tomorrow at</h3>
            <ul>
                @foreach($candidates as $candidate)
                <li class="field"><span class="tag is-medium">{{ $candidate }}</span></li>
                @endforeach
            </ul>
            @else
            <h3 class="title is-3">sorry, no schedules matched up</h3>
            @endif
        </div>
    </div>
</div>
@endsection
