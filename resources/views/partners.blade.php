@extends('app')

@section('content')
<div class="container has-text-centered">
    <div class="columns">
        <div class="column is-6 is-offset-3">

            @if (count($partners) !== 0)
            <h3 class="title is-4">who you want to talk over coffee?</h3>
            <div class="tags">
                <div class="field is-grouped is-grouped-multiline">
                    @foreach($partners as $i => $partner)
                    <div class="control">
                        <div class="tag is-large is-white is-rounded">
                            <label for="partner_{{ $i }}" class="label">
                                {{ Form::radio('partner', $partner->getId(), null, ['id' => 'partner_' . $i]) }}
                                {{ $partner->getName() }}
                            </label>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="field">
                <div class="control has-text-centered">
                    <button id="check" class="button is-link">
                        {{ __('check schedule') }}
                    </button>
                </div>
            </div>
            @else
            <h3 class="title is-3">it seems that everyone is very busy</h3>
            @endif

        </div>
    </div>
</div>

<script>
    document.getElementById('check').addEventListener('click', function () {
        const radios = document.getElementsByName('partner')
        let partner = ''
        for (let i = 0; i < radios.length; i++) {
            if (radios[i].checked) {
                partner = radios[i].value
                break
            }
        }

        if (partner === '') {} else {
            location.href = '/partner/' + partner;
        }
    });

</script>
@endsection
