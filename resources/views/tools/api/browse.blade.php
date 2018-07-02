@extends('voyager::master')

@section('page_title', ucfirst($apiType->name) . " Api Browser")

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="fa fa-cloud" aria-hidden="true"></i> {{ ucfirst($apiType->name) }} API Browser
            <a class="btn btn-warning btn-lg" href="{{ route('voyager.api.builder.index') }}">
                <i class="fa fa-bars pr-2" aria-hidden="true"></i> Back To List
            </a>
        </h1>

    </div>

    <style>
        pre.json-prettify {
            background-color: ghostwhite;
            border: 1px solid silver;
            padding: 10px 20px;
            margin: 20px;
        }

        .json-key {
            color: brown;
        }

        .json-value {
            color: navy;
        }

        .json-string {
            color: olive;
        }
    </style>
@stop

@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header secondary-color white-text py-5">
                        <h3 class="" style="font-weight:normal">
                            <span style="font-weight:bold">{{ ucfirst($apiType->name) }}</span> Api Urls
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <label for="collectionUrlID" class="grey-text">Collection Url</label>
                                <input type="email" id="collectionUrlID"
                                       value="{{ route('voyager.api.'.$apiType->slug.'.index') }}" readonly=""
                                       class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <label for="individualUrlID" class="grey-text">Individual Url</label>
                                <input type="email" id="individualUrlID"
                                       value="{{ route('voyager.api.'.$apiType->slug.'.index') }}/{id}" readonly=""
                                       class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <label for="currentUrl" class="grey-text">Current Url</label>
                                <input type="email" id="currentUrl"
                                       value="{{ route('voyager.api.'.$apiType->slug.'.index') }}"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <label for="individualID" class="grey-text">Id</label>
                                <input type="text" class="form-control" id="individualID">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <button class="btn btn-primary float-right mx-0"
                                        onclick="CallAjax( 'currentUrl' ,'individualResult','individualID')">
                                    Execute
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <label class="grey-text">Response</label>
                                <pre class="json-prettify mx-0"><code id="individualResult"></code></pre>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('javascript')

    <script>

        if (!library)
            var library = {};

        library.json = {
            replacer: function (match, pIndent, pKey, pVal, pEnd) {
                var key = '<span class=json-key>';
                var val = '<span class=json-value>';
                var str = '<span class=json-string>';
                var r = pIndent || '';
                if (pKey)
                    r = r + key + pKey.replace(/[": ]/g, '') + '</span>: ';
                if (pVal)
                    r = r + (pVal[0] == '"' ? str : val) + pVal + '</span>';
                return r + (pEnd || '');
            },
            prettyPrint: function (obj) {
                var jsonLine = /^( *)("[\w]+": )?("[^"]*"|[\w.+-]*)?([,[{])?$/mg;
                return JSON.stringify(obj, null, 3)
                    .replace(/&/g, '&amp;').replace(/\\"/g, '&quot;')
                    .replace(/</g, '&lt;').replace(/>/g, '&gt;')
                    .replace(jsonLine, library.json.replacer);
            }
        };


        function CallAjax(url, id, data = null) {
            url = $('#' + url).val();
            if (data) {
                val = $('#' + data).val();
                url += "/" + val;
                console.log(url);
            }
            $('#' + id).html('');
            $.ajax({
                url: url,
                success: function (data) {
                    //console.log(data);
                    $('#' + id).html(library.json.prettyPrint(data));
                },
                error: function (e) {
                    $('#' + id).html(library.json.prettyPrint(e));
                }
            });
        }
    </script>
@endsection