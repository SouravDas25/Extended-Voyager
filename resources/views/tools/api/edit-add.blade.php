@extends('voyager::master')

@section('page_title', "Add API Resource")

@section('page_header')
    <div class="page-title">
        <i class="voyager-data"></i>
        Add An API Resource
    </div>
@stop


@section('content')
    <div class="page-content container-fluid" id="voyagerAPIEditAdd">
        <div class="row">
            <div class="col-md-12">
                <form action="@if($is_edit){{ route('voyager.api.builder.update', $dataType->id) }}@else{{ route('voyager.api.builder.store') }}@endif"
                      method="POST" role="form">
                    @if($is_edit)
                        <input type="hidden" value="{{ $dataType->id }}" name="id">
                        {{ method_field("PUT") }}
                    @endif
                <!-- CSRF TOKEN -->
                    {{ csrf_field() }}

                    <div class="panel panel-primary panel-bordered">

                        <div class="panel-heading">
                            <h3 class="panel-title panel-icon">
                                <i class="fa fa-refresh"></i>
                                {{ ucfirst($table) }} Api Resource Info
                            </h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-up" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="row clearfix">
                                <div class="col-md-6 form-group">
                                    <label for="name">{{ __('voyager::database.table_name') }}</label>
                                    <input type="text" class="form-control" readonly name="name" placeholder="{{ __('generic_name') }}"
                                           value="@if(isset($dataType)){{ $dataType->name }}@else{{ $table }}@endif">
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-md-6 form-group">
                                    <label for="display_name_singular">{{ __('voyager::bread.display_name_singular') }}</label>
                                    <input type="text" class="form-control"
                                           name="display_name_singular"
                                           id="display_name_singular"
                                           placeholder="{{ __('voyager::bread.display_name_singular') }}"
                                           value="@if(isset($dataType)){{ $dataType->display_name_singular }}@else{{ $display_name }}@endif">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="display_name_plural">{{ __('voyager::bread.display_name_plural') }}</label>
                                    <input type="text" class="form-control"
                                           name="display_name_plural"
                                           id="display_name_plural"
                                           placeholder="{{ __('voyager::bread.display_name_plural') }}"
                                           value="@if(isset($dataType)){{ $dataType->display_name_plural }}@else{{ $display_name_plural }}@endif">
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-md-6 form-group">
                                    <label for="slug">{{ __('voyager::bread.url_slug') }}</label>
                                    <input type="text" class="form-control" name="slug" placeholder="{{ __('voyager::bread.url_slug_ph') }}"
                                           value="@if(isset($dataType)){{ $dataType->slug }}@else{{ $slug }}@endif">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="model_name">{{ __('voyager::bread.model_name') }}</label>
                                    <span class="voyager-question"
                                          aria-hidden="true"
                                          data-toggle="tooltip"
                                          data-placement="right"
                                          title="{{ __('voyager::bread.model_name_ph') }}"></span>
                                    <input type="text" class="form-control" name="model_name" placeholder="{{ __('voyager::bread.model_class') }}"
                                           value="@if(isset($dataType)){{ $dataType->model_name }}@else{{ $model_name }}@endif">
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-md-6 form-group">
                                    <label for="controller">{{ __('voyager::bread.controller_name') }}</label>
                                    <span class="voyager-question"
                                          aria-hidden="true"
                                          data-toggle="tooltip"
                                          data-placement="right"
                                          title="{{ __('voyager::bread.controller_name_hint') }}"></span>
                                    <input type="text" class="form-control" name="controller" placeholder="{{ __('voyager::bread.controller_name') }}"
                                           value="@if(isset($dataType)){{ $dataType->controller }}@endif">
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="server_side">Paginate</label><br>
                                    <?php $checked = (isset($dataType->server_side) && $dataType->server_side == 1) ? true : (isset($server_side) && $server_side) ? true : false; ?>
                                    <input type="checkbox" name="server_side" class="toggleswitch" data-on="{{ __('voyager::generic.yes') }}" data-off="{{ __('voyager::generic.no') }}"
                                           @if($checked) checked @endif>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description">{{ __('voyager::bread.description') }}</label>
                                <textarea class="form-control" name="description"
                                          placeholder="{{ __('voyager::bread.description') }}"
                                >@if(isset($dataType->description)){{ $dataType->description }}@endif</textarea>
                            </div>
                        </div><!-- .panel-body -->
                    </div><!-- .panel -->

                    <button type="submit" class="btn pull-right btn-primary">{{ __('voyager::generic.submit') }}</button>

                </form>
            </div><!-- .col-md-12 -->
        </div><!-- .row -->
    </div><!-- .page-content -->

@stop

@section('javascript')
    <script>
        $(function () {


            $('.toggleswitch').bootstrapToggle();


        });

    </script>
@stop
