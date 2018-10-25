@extends('app')

@section('content')
<div>
    <h3>you and {{ $user->getName() }} can have coffee tomorrow at</h3>
    <ul>
        @foreach($candidates as $candidate)
        <li>{{ $candidate }}</li>
        @endforeach
    </ul>
</div>
@endsection
