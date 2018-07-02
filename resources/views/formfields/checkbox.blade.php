<br>
<?php $checked = false; ?>
@if(isset($dataTypeContent->{$row->field}) || old($row->field))
    <?php $checked = old($row->field, $dataTypeContent->{$row->field}); ?>
@else
    <?php $checked = isset($options->checked) && $options->checked ? true : false; ?>
@endif

@if(isset($options->on) && isset($options->off))
    <div class="switch mdb-color-switch">
        <label>
            {{ $options->off }}
            <input type="checkbox" name="{{ $row->field }}" @if($checked) checked="checked" @endif>
            <span class="lever"></span>
            {{ $options->on }}
        </label>
    </div>
@else
    <div class="switch mdb-color-switch">
        <label>
            No
            <input type="checkbox" name="{{ $row->field }}" @if($checked) checked="checked" @endif>
            <span class="lever"></span>
            Yes
        </label>
    </div>
@endif
