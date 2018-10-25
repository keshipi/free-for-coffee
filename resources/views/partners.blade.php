@extends('app')

@section('content')
<div>
    <h3>who you want to talk over coffee?</h3>
    {!! Form::open(['method' => 'post', 'route' => ['partner.index']]) !!}
    <ul>
        @foreach($partners as $i => $partner)
        <li>
        {{ Form::radio('partner', $partner->getId(), null, ['id' => 'partner_' . $i]) }}
        {{ Form::label('partner_' . $i, $partner->getName()) }}
        </li>
        @endforeach
    </ul>
    {{ Form::button('check schedule', ['id' => 'check']) }}
    {!! Form::close() !!}
</div>

<script>
document.getElementById('check').addEventListener('click', function() {
    const radios = document.getElementsByName('partner')
    let partner = ''
    for(let i = 0; i < radios.length; i++) {
        if (radios[i].checked) {
            partner = radios[i].value
            break
        }
    }

    if (partner === '') {
    } else {
        location.href = '/partner/' + partner;
    }
});
</script>

@endsection
