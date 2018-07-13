<?php $selected_value = (isset($dataTypeContent->{$row->field}) && !empty(old(
    $row->field,
                $dataTypeContent->{$row->field}
))) ? old(
                    $row->field,
        $dataTypeContent->{$row->field}
                ) : old($row->field); ?>
                                        <?php $default = (isset($options->default) && !isset($dataTypeContent->{$row->field})) ? $options->default : null; ?>
@if(isset($options->options))
    @foreach($options->options as $key => $option)
        <div class="form-check">
            <input type="radio" id="option-{{ str_slug($row->field, '-') }}-{{ str_slug($key, '-') }}"
                   name="{{ $row->field }}" class="form-check-input"
                   value="{{ $key }}" @if($default == $key && $selected_value === NULL){{ 'checked' }}@endif @if($selected_value == $key){{ 'checked' }}@endif>
            <label for="option-{{ str_slug($row->field, '-') }}-{{ str_slug($key, '-') }}" class="form-check-label">
                {{ $option }}
            </label>
        </div>
    @endforeach
@endif
