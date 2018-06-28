@extends('voyager::master')

@section('page_title', "Api Keys Console")

@section('page_header')
    <h1 class="page-title">
        <i class="fa fa-cloud" aria-hidden="true"></i> API Keys Console
    </h1>
    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#centralModalInfo">
        <i class="icon-key-4 pr-2"></i> Add A Key
    </button>
    <a class="btn btn-warning btn-lg" href="{{ route('voyager.api.builder.index') }}">
        <i class="fa fa-bars pr-2" aria-hidden="true"></i> Back To List
    </a>
@stop

@section('content')
    <div class="page-content container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <table id="example" class="table table-striped table-bordered table-responsive-md mb-0 " cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Api Key</th>
                            <th>Disabled</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($apiKeys as $apiKey)
                        <tr>
                            <td>
                                <span class="font-weight-800">{{ $apiKey->name }}</span>
                            </td>
                            <td>{{ $apiKey->api_key }}</td>
                            <td>
                                <div class="switch" onchange="updateDisableColumn('{{ route('voyager.api-keys.edit',['id' => $apiKey->id]) }}')">
                                    <label>
                                        No
                                        <input type="checkbox" @if($apiKey->block) checked @endif>
                                        <span class="lever"></span>
                                        Yes
                                    </label>
                                </div>
                            </td>
                            <td>
                                <form action="{{ route('voyager.api-keys.destroy' ,['id' => $apiKey->id]) }}" method="POST" >
                                    @method('DELETE')
                                    {{ csrf_field() }}
                                    <button class="btn btn-danger btn-sm" type="submit">
                                        <i class="voyager-trash"></i> {{ __('voyager::generic.delete') }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="centralModalInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-notify modal-info" role="document">
        <!--Content-->
        <form class="modal-content" method="POST" action="{{ route('voyager.api-keys.store') }}">
            <!--Header-->
            <div class="modal-header">
                <p class="heading lead">Create An Api Key</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>

            <!--Body-->
            <div class="modal-body">
                {{ csrf_field() }}
                <div>
                    <label for="name">Api Name</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
            </div>

            <!--Footer-->
            <div class="modal-footer justify-content-center">
                <div class="col-sm-12">
                    <a type="button" class="btn btn-default btn-lg waves-effect float-right" data-dismiss="modal">Cancel</a>
                    <input type="submit" class="btn btn-primary float-right" value="Save">
                </div>
            </div>
        </form>
        <!--/.Content-->
    </div>
    </div>
@endsection


@section('javascript')
    <script>
        function updateDisableColumn(url){
            $.ajax({
                url : url,
                success : function (data) {
                    if(data.block){
                        toastr["success"]("Api " + data.name + " Disabled");
                    }
                    else {
                        toastr["success"]("Api " + data.name + " Enabled");
                    }
                },
                error : function (e) {
                    toastr["error"](JSON.stringify(e));
                }
            })
        }
    </script>
@endsection