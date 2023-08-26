@php
    $type ??= 'text';
    $class ??= null;
    $name ??= '';
    $value ??= '';
    $label ??= ucfirst($name);
    $attribute ??='';
@endphp

<div @class(['form-group', $class]) {{$attribute}}>
    <label for="{{$name}}">{{ $label }}</label>
    @if ($type=== 'textarea')

        <textarea class="form-control textarea @error($name) is-invalid @enderror" type="{{ $type }}" id="{{ $name }}" name="{{ $name }}"> {{ old($name, $value) }} </textarea>


    @elseif ($type === 'number')

        <input class="form-control @error($name) is-invalid @enderror" step="any" type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" value="{{ old($name, $value) }}">

    @else

        <input class="form-control @error($name) is-invalid @enderror" type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" value="{{ old($name, $value) }}">

    @endif
    @error($name)
        <div class="invalid-feedback">
            {{ $message  }}
        </div>
    @enderror
</div>
