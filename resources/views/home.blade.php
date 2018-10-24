@extends('app')

@section('content')
<div>
    <h3>tell us your tomorrow schedule:)</h3>
    <h4>{{ $tomorrow }}</h4>
    {!! Form::open(['method' => 'post', 'route' => ['date.store']]) !!}
    <ul>
        @foreach($slots as $slot)
        <li>{{ Form::checkbox('schedules[]', $slot, $mySlots->contains($slot)) }}{{ $slot }}</li>
        @endforeach
    </ul>
    {{ Form::button('save', ['type' => 'submit']) }}
    {!! Form::close() !!}
</div>
@endsection
