@extends('voyager::master')

@section('page_title', $dataType->display_name_plural . ' ' . __('voyager::bread.order'))

@section('page_header')
<h1 class="page-title">
	<i class="voyager-list"></i>{{ $dataType->display_name_plural }} {{ __('voyager::bread.order') }}
</h1>
<a href="{{ route('voyager.'.$dataType->slug.'.index') }}" class="btn btn-lg btn-warning">
	<span class="glyphicon glyphicon-list"></span>&nbsp;
	{{ __('voyager::generic.return_to_list') }}
</a>
@stop

@section('content')
<div class="page-content container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card ">
				<div class="card-header primary-color white-text">
					<p class="card-title">{{ __('voyager::generic.drag_drop_info') }}</p>
				</div>

				<div class="card-body" style="padding:30px;">
					<div class="dd">
						<ol class="dd-list">
							@foreach ($results as $result)
							<li class="dd-item" data-id="{{ $result->getKey() }}">
								<div class="dd-handle">
									<span>{{ $result->{$display_column} }}</span>
								</div>
							</li>
							@endforeach
						</ol>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@stop

@section('javascript')

<script>
$(document).ready(function () {
	$('.dd').nestable({
		maxDepth: 1
	});
	/**
	* Reorder items
	*/
	$('.dd').on('change', function (e) {
		$.post('{{ route('voyager.'.$dataType->slug.'.order') }}', {
			order: JSON.stringify($('.dd').nestable('serialize')),
			_token: '{{ csrf_token() }}'
		}, function (data) {
			toastr.success("{{ __('voyager::bread.updated_order') }}");
		});
	});
});
</script>
@stop
