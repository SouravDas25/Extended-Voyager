@php
    $voyager_mde_content_onedit = "";
    if(isset($dataTypeContent->{$row->field})){
    $voyager_mde_content_onedit = old($row->field, $dataTypeContent->{$row->field});
    } else{
    $voyager_mde_content_onedit = old($row->field);
    }
@endphp
<div id="editor">
    <textarea class="form-control w-100" name="{{ $row->field }}" style="height: 200px"
              id="markdown{{ $row->field }}" :value="input" @input="update">
    </textarea>
    <div v-html="compiledMarkdown"></div>
</div>

@push('javascript')
    <script src="https://unpkg.com/marked@0.3.6"></script>
    <script src="https://unpkg.com/lodash@4.16.0"></script>
    <script>
        $(function () {
            new Vue({
                el: '#editor',
                data: {
                    input: '{{ $voyager_mde_content_onedit }}'
                },
                computed: {
                    compiledMarkdown: function () {
                        return marked(this.input, {sanitize: true})
                    }
                },
                methods: {
                    update: _.debounce(function (e) {
                        this.input = e.target.value
                    }, 300)
                }
            })
        })
    </script>
@endpush
