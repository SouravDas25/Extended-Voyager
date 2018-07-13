<div id="{{ $row->field }}" data-theme="{{ @$options->theme }}" data-language="{{ @$options->language }}"
     class="ace_editor " style="min-height: 200px"
     name="{{ $row->field }}">@if(isset($dataTypeContent->{$row->field})){{ old($row->field, $dataTypeContent->{$row->field}) }}@elseif(isset($options->default)){{ old($row->field, $options->default) }}@else{{ old($row->field) }}@endif</div>
<textarea name="{{ $row->field }}" id="{{ $row->field }}_textarea"
          class="d-none">@if(isset($dataTypeContent->{$row->field})){{ old($row->field, $dataTypeContent->{$row->field}) }}@elseif(isset($options->default)){{ old($row->field, $options->default) }}@else{{ old($row->field) }}@endif</textarea>
