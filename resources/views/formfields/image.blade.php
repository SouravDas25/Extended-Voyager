
<div class="md-form">
    <div class="file-field" style="width: 350px">
        <div class="z-depth-1-half mb-4" >
            <img
            @if(isset($dataTypeContent->{$row->field}))
            src="@if( !filter_var($dataTypeContent->{$row->field}, FILTER_VALIDATE_URL)){{ Voyager::image( $dataTypeContent->{$row->field} ) }}@else{{ $dataTypeContent->{$row->field} }}@endif"
            @else
            src="{{ voyager_asset('/images/placeholder.jpg') }}"
            @endif
            class="img-fluid" id="{{ $row->field }}_img">
        </div>
        <div class="d-flex pl-0">
            <div class="btn btn-primary float-left ml-0">
                <span>Choose an Image</span>
                <input type="file" name="{{ $row->field }}" accept="image/*" onchange="imageB4Uploadfile(this.files,'{{ $row->field }}_img')"
                       @if($row->required == 1 && !isset($dataTypeContent->{$row->field})) required @endif>
            </div>
        </div>
    </div>
</div>