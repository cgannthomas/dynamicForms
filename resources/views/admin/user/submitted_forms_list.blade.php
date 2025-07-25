@extends('admin.layouts.dashboard-layout')
@section('pageTitle','User Submitted Datas')


@section('breadcrumbs')

	@php
        $breadcrumbTitle = 'User Submitted Data';
        $breadcrumbs = [['title' => 'Lists', 'route'
                => null, 'status' => 'active']];
    @endphp
    @component('components.breadcrumb',compact('breadcrumbs','breadcrumbTitle')) @endcomponent

@endsection

@section('content')

	<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
		<!--begin::Container-->
		<div id="kt_content_container" class="container-xxl">
			@if(session('commonSuccess'))
				<div class="alert alert-success">
					{{ session('commonSuccess') }}
				</div>
			@endif

			@if(session('commonError'))
				<div class="alert alert-danger">
					{{ session('commonError') }}
				</div>
			@endif
			<!--begin::Card-->
			<div class="card">
				<!--begin::Card body-->
				<div class="card-body pt-0">
					<!--begin::Table-->
					@component('components.datatable',compact('dataTable')) @endcomponent
					
					<!--end::Table-->
				</div>
				<!--end::Card body-->
			</div>
			<!--end::Card-->
		</div>
	</div>
	@push('js')	
        <script src="{{ asset('admin-panel/assets/js/form/form_actions.js') }}"></script>
    @endpush
@endsection