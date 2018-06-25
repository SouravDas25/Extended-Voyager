@extends('voyager::master')

@section('page_title', "Api Builder")

@section('page_header')
    <h1 class="page-title">
        <i class="fa fa-refresh"></i> API Builder
    </h1>
    <button class="btn btn-primary btn-lg">
        API Keys
    </button>
@stop

@section('content')

    <div class="page-content container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-12">

                <table class="table table-striped table-bordered table-hover database-tables">
                    <thead class="cyan lighten-3">
                    <tr>
                        <th>{{ __('voyager::database.table_name') }}</th>
                        <th style="text-align:right">API CRUD Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tables as $table)
                        @continue(in_array($table->name, config('voyager.database.tables.hidden', [])))
                        <tr>
                            <td>
                                <p class="name">
                                    <a href="{{ route('voyager.database.show', $table->name) }}"
                                       data-name="{{ $table->name }}" class="desctable">
                                        {{ $table->name }}
                                    </a>
                                    <i class="voyager-data"
                                       style="font-size:25px; position:absolute; margin-left:10px; margin-top:-3px;"></i>
                                </p>
                            </td>
                            <td class="actions text-right">
                                @if($table->dataTypeId)
                                    <a href="{{ route('voyager.' . $table->slug . '.index') }}"
                                       class="btn btn-warning btn-sm browse_bread" style="margin-right: 0;">
                                        <i class="voyager-plus"></i> Browse
                                    </a>
                                    <a href="{{ route('voyager.bread.edit', $table->name) }}"
                                       class="btn btn-primary btn-sm edit">
                                        <i class="voyager-edit"></i> {{ __('voyager::generic.edit') }}
                                    </a>
                                    <a href="#delete-bread" data-id="{{ $table->dataTypeId }}" data-name="{{ $table->name }}"
                                       class="btn btn-danger btn-sm delete">
                                        <i class="voyager-trash"></i> {{ __('voyager::generic.delete') }}
                                    </a>
                                @else
                                    <a href="{{ route('voyager.api.builder.create', ['name' => $table->name]) }}"
                                       class="_btn btn-default btn-sm pull-right">
                                        <i class="voyager-plus"></i> Add Api Resources to this Table
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="table_info" role="dialog">
        <div class="modal-dialog modal-notify modal-info">
            <div class="modal-content ">
                <div class="modal-header">
                    <h4 class="modal-title "><i class="voyager-data"></i> @{{ table.name }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="white-text">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="overflow:scroll">
                    <table class="table table-striped">
                        <thead class="blue-grey lighten-4">
                        <tr>
                            <th>{{ __('voyager::database.field') }}</th>
                            <th>{{ __('voyager::database.type') }}</th>
                            <th>{{ __('voyager::database.null') }}</th>
                            <th>{{ __('voyager::database.key') }}</th>
                            <th>{{ __('voyager::database.default') }}</th>
                            <th>{{ __('voyager::database.extra') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="row in table.rows">
                            <td><strong>@{{ row.Field }}</strong></td>
                            <td>@{{ row.Type }}</td>
                            <td>@{{ row.Null }}</td>
                            <td>@{{ row.Key }}</td>
                            <td>@{{ row.Default }}</td>
                            <td>@{{ row.Extra }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">{{ __('voyager::generic.close') }}</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@stop

@section('javascript')

    <script>

        var table = {
            name: '',
            rows: []
        };

        new Vue({
            el: '#table_info',
            data: {
                table: table,
            },
        });


        $(function () {

            $('.database-tables').on('click', '.desctable', function (e) {
                e.preventDefault();
                href = $(this).attr('href');
                table.name = $(this).data('name');
                table.rows = [];
                $.get(href, function (data) {
                    $.each(data, function (key, val) {
                        table.rows.push({
                            Field: val.field,
                            Type: val.type,
                            Null: val.null,
                            Key: val.key,
                            Default: val.default,
                            Extra: val.extra
                        });
                        $('#table_info').modal('show');
                    });
                });
            });
        });
    </script>

@stop