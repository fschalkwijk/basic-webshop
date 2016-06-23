<?php
if(empty($type)) $type = 'text';
if(empty($item)) $item = [];
if(empty($attrs)) $attrs = [];
if(empty($default)) $default = null;
if(empty($id)) $id = 'input_'.$name;
if(empty($property)) $property = $name;
?>

<div class="form-group {{ $errors->has($name) ? 'has-error' : '' }}">
    @if(isset($title))
    <label for="{{ $id }}">{{ $title }}</label>
    @endif

    <input
        id="{{ $id }}"
        type="{{ $type }}"
        class="form-control"
        name="{{ $name }}"
        placeholder="{{ $placeholder or '' }}"
        @if($type != 'password')
        value="{{ old($name, attr($item, $property, $default)) }}"
        @endif
        @if(!isset($required) || $required != false)
        required
        @endif
        @foreach($attrs as $key => $value)
        {{ $key }}="{{ $value }}"
        @endforeach>

    @if($errors->has($name))
        <p class="help-block">
            {{ $errors->first($name) }}
        </p>
    @elseif(!empty($help))
        <p class="help-block">
            {{ $help }}
        </p>
    @endif
</div>
