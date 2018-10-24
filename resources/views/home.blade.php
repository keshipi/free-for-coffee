@extends('app')

@section('content')
<div>
    <h3>tell us your tomorrow schedule:)</h3>
    <h4>{{ $tomorrow->format(config('app.date_format_show')) }}</h4>
    {!! Form::open(['method' => 'post', 'route' => ['date.store']]) !!}
    {{ Form::hidden('tomorrow', $tomorrow->format(config('app.date_format_db'))) }}
    <ul>
        @foreach($slots as $slot)
        <li>{{ Form::checkbox('slots[]', $slot, $mySlots->contains($slot)) }}{{ $slot }}</li>
        @endforeach
    </ul>
    {{ Form::button('save', ['type' => 'submit']) }}
    {!! Form::close() !!}
</div>
@endsection
