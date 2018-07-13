<br>
@if(isset($dataTypeContent->{$row->field}))
    <?php $images = json_decode($dataTypeContent->{$row->field}); ?>
    @if($images != null)
        @foreach($images as $image)
            <div class="img_settings_container" data-field-name="{{ $row->field }}" style="float:left;padding-right:15px;">
                <img src="{{ Voyager::image( $image ) }}" data-image="{{ $image }}" data-id="{{ $dataTypeContent->id }}" style="max-width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:5px;">
                <a href="#" class="voyager-x remove-multi-image"></a>
            </div>
        @endforeach
    @endif
@endif
<div class="clearfix"></div>
<div class="md-form mt-1">
    <div class="file-field">
        <div class="btn btn-primary btn-sm float-left">
            <span>Choose your Images</span>
            <input type="file" name="{{ $row->field }}[]" multiple="multiple"
                   @if($row->required == 1) required @endif>
        </div>
        <div class="file-path-wrapper">
            <input class="file-path validate"
                   type="text"
                   placeholder="Upload your file">
        </div>
    </div>
</div>
