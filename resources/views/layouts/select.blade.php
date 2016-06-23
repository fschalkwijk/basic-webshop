<?php
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

    <select
        id="{{ $id }}"
        class="form-control"
        name="{{ $name }}"
        value="{{ old($name, attr($item, $property, $default)) }}"
        @if(!isset($required) || $required != false)
        required
        @endif
        @foreach($attrs as $propterty => $val)
        {{ $propterty }}="{{ $val }}"
        @endforeach>
        <option value>{{ $placeholder or '' }}</option>

        @foreach($options as $option)
        <option
            value="{{ attr($option, $key) }}"
            @if(old($name, attr($item, $property, $default)) == attr($option, $key))
            selected
            @endif>
            {{ attr($option, $value) }}
        </option>
        @endforeach

    </select>

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
