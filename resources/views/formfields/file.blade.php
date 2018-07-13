@if(isset($dataTypeContent->{$row->field}))
    @if(json_decode($dataTypeContent->{$row->field}))
        <ul class="list-group">
        @foreach(json_decode($dataTypeContent->{$row->field}) as $file)
            <a class="fileType list-group-item waves-light" target="_blank"
               href="{{ Storage::disk(config('voyager.storage.disk'))->url($file->download_link) ?: '' }}">
                {{ $file->original_name ?: '' }}
            </a>
        @endforeach
        </ul>
    @else
        <a class="fileType" target="_blank" href="{{ Storage::disk(config('voyager.storage.disk'))->url($dataTypeContent->{$row->field}) }}">
            Download
        </a>
    @endif
@endif
<div class="md-form mt-1">
    <div class="file-field">
        <div class="btn btn-primary btn-sm float-left">
            <span>Choose file</span>
            <input type="file" name="{{ $row->field }}[]" multiple="multiple"
                   @if($row->required == 1 && !isset($dataTypeContent->{$row->field})) required @endif>
        </div>
        <div class="file-path-wrapper">
            <input class="file-path validate"
                   type="text"
                   placeholder="Upload your file">
        </div>
    </div>
</div>