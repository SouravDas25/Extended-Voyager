@extends('voyager::master')

@section('css')

    @include('voyager::compass.includes.styles')

@stop

@section('page_header')
    <div class="container-fluid" >
        <h1 class="page-title">
            <i class="voyager-compass"></i>
            <p> {{ __('voyager::generic.compass') }}</p>
            <span class="page-description">{{ __('voyager::compass.welcome') }}</span>
        </h1>
    </div>
@stop

@section('content')

    <div id="gradient_bg"></div>

    <div class="container-fluid">
        @include('voyager::alerts')
    </div>

    <div class="page-content compass container-fluid ">
        <ul class="nav nav-tabs indigo lighten-1" role="tablist">
            <li class=" nav-item @if(empty($active_tab) || (isset($active_tab) && $active_tab == 'resources')){!! 'active' !!}@endif">
                <a data-toggle="tab" href="#resources" class="nav-link grey-text" role="tab">
                    <i class="voyager-book"></i> {{ __('voyager::compass.resources.title') }}
                </a>
            </li>
            <li class=" nav-item @if($active_tab == 'commands'){!! 'active' !!}@endif">
                <a data-toggle="tab" href="#commands" class="nav-link grey-text" role="tab">
                    <i class="voyager-terminal"></i> {{ __('voyager::compass.commands.title') }}
                </a>
            </li>
            <li class=" nav-item @if($active_tab == 'logs'){!! 'active' !!}@endif">
                <a data-toggle="tab" href="#logs" class="nav-link grey-text" role="tab">
                    <i class="voyager-logbook"></i> {{ __('voyager::compass.logs.title') }}
                </a>
            </li>
        </ul>


        <div class="tab-content">
            <div id="resources"
                 class="tab-pane fade in @if(empty($active_tab) || (isset($active_tab) && $active_tab == 'resources')){!! 'show active' !!}@endif">
                <h3><i class="voyager-book"></i> {{ __('voyager::compass.resources.title') }}
                    <small>{{ __('voyager::compass.resources.text') }}</small>
                </h3>

                <div class="collapsible">
                    <a class="collapse-head" data-toggle="collapse" data-target="#links" aria-expanded="true"
                         aria-controls="links">
                        <h4>{{ __('voyager::compass.links.title') }}</h4>
                        <i class="voyager-angle-down"></i>
                        <i class="voyager-angle-up"></i>
                    </a>
                    <div class="collapse-content multi-collapse collapse in show" id="links" >
                        <div class="row">
                            <div class="col-md-4">
                                <a href="https://laravelvoyager.com/docs" target="_blank" class="voyager-link"
                                   style="background-image:url('{{ voyager_asset('images/compass/documentation.jpg') }}')">
                                    <span class="resource_label"><i class="voyager-documentation"></i> <span
                                                class="copy">{{ __('voyager::compass.links.documentation') }}</span></span>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="https://laravelvoyager.com" target="_blank" class="voyager-link"
                                   style="background-image:url('{{ voyager_asset('images/compass/voyager-home.jpg') }}')">
                                    <span class="resource_label"><i class="voyager-browser"></i> <span
                                                class="copy">{{ __('voyager::compass.links.voyager_homepage') }}</span></span>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="https://larapack.io" target="_blank" class="voyager-link"
                                   style="background-image:url('{{ voyager_asset('images/compass/hooks.jpg') }}')">
                                    <span class="resource_label"><i class="voyager-hook"></i> <span
                                                class="copy">{{ __('voyager::compass.links.voyager_hooks') }}</span></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="collapsible">

                    <div class="collapse-head" data-toggle="collapse" data-target="#fonts" aria-expanded="true"
                         aria-controls="fonts">
                        <h4>{{ __('voyager::compass.fonts.title') }}</h4>
                        <i class="voyager-angle-down"></i>
                        <i class="voyager-angle-up"></i>
                    </div>

                    <div class="collapse-content collapse in" id="fonts">

                        @include('voyager::compass.includes.fonts')

                    </div>

                </div>

                <div class="collapsible">

                    <div class="collapse-head" data-toggle="collapse" data-target="#fontello-fonts" aria-expanded="true"
                         aria-controls="fontello-fonts">
                        <h4>Fontello Css Icons</h4>
                        <i class="voyager-angle-down"></i>
                        <i class="voyager-angle-up"></i>
                    </div>

                    <div class="collapse-content collapse in show grey lighten-4" id="fontello-fonts">

                        @include('voyager::compass.includes.fontello-fonts')

                    </div>

                </div>

            </div>

            <div id="commands" class="tab-pane fade in @if($active_tab == 'commands'){!! 'active' !!}@endif">
                <h3><i class="voyager-terminal"></i> {{ __('voyager::compass.commands.title') }}
                    <small>{{ __('voyager::compass.commands.text') }}</small>
                </h3>
                <div id="command_lists">
                    @include('voyager::compass.includes.commands')
                </div>

            </div>
            <div id="logs" class="tab-pane fade in @if($active_tab == 'logs'){!! 'active' !!}@endif">
                <div class="row">

                    @include('voyager::compass.includes.logs')

                </div>
            </div>
        </div>

    </div>

@stop
@section('javascript')
    <script>
        $('document').ready(function () {
            $('.collapse-head').click(function () {
                var collapseContainer = $(this).parent();
                if (collapseContainer.find('.collapse-content').hasClass('in')) {
                    collapseContainer.find('.voyager-angle-up').fadeOut('fast');
                    collapseContainer.find('.voyager-angle-down').fadeIn('slow');
                } else {
                    collapseContainer.find('.voyager-angle-down').fadeOut('fast');
                    collapseContainer.find('.voyager-angle-up').fadeIn('slow');
                }
            });
        });

        $(function () {
            $.ajax({
                url : '{{ voyager_asset('/data/fontello-config.json') }}',
                success : fontFontsExplode,
                error : function (e) {
                    console.log(e)
                }
            })
        });
    </script>
    <!-- JS for commands -->
    <script>

        $(document).ready(function () {
            $('.command').click(function () {
                $(this).find('.cmd_form').slideDown();
                $(this).addClass('more_args');
                $(this).find('input[type="text"]').focus();
            });

            $('.close-output').click(function () {
                $('#commands pre').slideUp();
            });
        });

    </script>

    <!-- JS for logs -->
    <script>
        $(document).ready(function () {
            $('.table-container tr').on('click', function () {
                $('#' + $(this).data('display')).toggle();
            });
            $('#table-log').DataTable({
                "order": [1, 'desc'],
                "stateSave": true,
                "language": {!! json_encode(__('voyager::datatable')) !!},
                "stateSaveCallback": function (settings, data) {
                    window.localStorage.setItem("datatable", JSON.stringify(data));
                },
                "stateLoadCallback": function (settings) {
                    var data = JSON.parse(window.localStorage.getItem("datatable"));
                    if (data) data.start = 0;
                    return data;
                }
            });

            $('#delete-log, #delete-all-log').click(function () {
                return confirm('{{ __('voyager::generic.are_you_sure') }}');
            });
        });
    </script>
@stop
